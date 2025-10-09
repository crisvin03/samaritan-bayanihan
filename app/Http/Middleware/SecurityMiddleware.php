<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class SecurityMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $ip = $request->ip();
        $userAgent = $request->userAgent();
        
        // Check IP blacklist
        if ($this->isIpBlacklisted($ip)) {
            Log::warning('Blocked request from blacklisted IP', [
                'ip' => $ip,
                'user_agent' => $userAgent,
                'url' => $request->url()
            ]);
            
            return response()->json(['error' => 'Access denied'], 403);
        }
        
        // Rate limiting for registration
        if ($request->is('register') && $request->isMethod('post')) {
            if ($this->isRateLimited($ip, 'registration')) {
                Log::warning('Registration rate limit exceeded', [
                    'ip' => $ip,
                    'user_agent' => $userAgent
                ]);
                
                return back()->with('error', 'Too many registration attempts. Please try again later.');
            }
        }
        
        // Rate limiting for verification attempts
        if ($request->is('*verification*') && $request->isMethod('post')) {
            if ($this->isRateLimited($ip, 'verification')) {
                Log::warning('Verification rate limit exceeded', [
                    'ip' => $ip,
                    'user_agent' => $userAgent
                ]);
                
                return back()->with('error', 'Too many verification attempts. Please try again later.');
            }
        }
        
        // Log suspicious activity
        $this->logSuspiciousActivity($request, $ip, $userAgent);
        
        return $next($request);
    }
    
    private function isIpBlacklisted($ip)
    {
        $blacklist = config('security.monitoring.ip_blacklist');
        if (empty($blacklist)) {
            return false;
        }
        
        $blacklistedIps = array_map('trim', explode(',', $blacklist));
        return in_array($ip, $blacklistedIps);
    }
    
    private function isRateLimited($ip, $type)
    {
        $key = "rate_limit_{$type}_{$ip}";
        $attempts = Cache::get($key, 0);
        $maxAttempts = config("security.rate_limiting.{$type}_attempts", 3);
        
        if ($attempts >= $maxAttempts) {
            return true;
        }
        
        Cache::put($key, $attempts + 1, now()->addHour());
        return false;
    }
    
    private function logSuspiciousActivity(Request $request, $ip, $userAgent)
    {
        if (!config('security.monitoring.log_suspicious_activity')) {
            return;
        }
        
        // Check for multiple registrations from same IP
        if ($request->is('register') && $request->isMethod('post')) {
            $recentRegistrations = User::where('ip_address', $ip)
                ->where('created_at', '>', now()->subHours(24))
                ->count();
                
            if ($recentRegistrations >= config('security.registration.max_attempts_per_ip', 3)) {
                Log::warning('Multiple registrations from same IP', [
                    'ip' => $ip,
                    'user_agent' => $userAgent,
                    'registrations_count' => $recentRegistrations,
                    'url' => $request->url()
                ]);
            }
        }
        
        // Check for suspicious user agents
        $suspiciousPatterns = [
            'bot', 'crawler', 'spider', 'scraper', 'curl', 'wget', 'python', 'php'
        ];
        
        foreach ($suspiciousPatterns as $pattern) {
            if (stripos($userAgent, $pattern) !== false) {
                Log::warning('Suspicious user agent detected', [
                    'ip' => $ip,
                    'user_agent' => $userAgent,
                    'pattern' => $pattern,
                    'url' => $request->url()
                ]);
                break;
            }
        }
    }
}