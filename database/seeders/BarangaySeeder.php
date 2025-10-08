<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class BarangaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // All 63 barangays in Bulan, Sorsogon
        $barangays = [
            'A. Bonifacio (Tinurilan)',
            'Abad Santos (Kambal)',
            'Aguinaldo (Lipata Dako)',
            'Antipolo',
            'Aquino (Imelda)',
            'Bical',
            'Beguin',
            'Bonga',
            'Butag',
            'Cadandanan',
            'Calomagon',
            'Calpi',
            'Cocok-Cabitan',
            'Daganas',
            'Danao',
            'Dolos',
            'E. Quirino (Pinangomhan)',
            'Fabrica',
            'G. Del Pilar (Tanga)',
            'Gate',
            'Inararan',
            'J. Gerona (Biton)',
            'J.P. Laurel (Pon-od)',
            'Jamorawon',
            'Libertad (Calle Putol)',
            'Lajong',
            'Magsaysay (Bongog)',
            'Managa-naga',
            'Marinab',
            'Nasuje',
            'Montecalvario',
            'N. Roque (Calayugan)',
            'Namo',
            'Obrero',
            'Osmeña (Lipata Saday)',
            'Otavi',
            'Padre Diaz',
            'Palale',
            'Quezon (Cabarawan)',
            'R. Gerona (Butag)',
            'Recto',
            'Roxas (Busay)',
            'Sagrada',
            'San Francisco (Polot)',
            'San Isidro (Cabugaan)',
            'San Juan Bag-o',
            'San Juan Daan',
            'San Rafael (Togbongon)',
            'San Ramon',
            'San Vicente',
            'Santa Remedios',
            'Santa Teresita (Trece)',
            'Sigad',
            'Somagongsong',
            'Tarhan',
            'Taromata',
            'Zone 1 (Ilawod)',
            'Zone 2 (Sabang)',
            'Zone 3 (Central)',
            'Zone 4 (Central Business District)',
            'Zone 5 (Canipaan)',
            'Zone 6 (Baybay)',
            'Zone 7 (Iraya)',
            'Zone 8 (Loyo)'
        ];

        $this->command->info('Bulan, Sorsogon barangays are now available in the system.');
        $this->command->info('Total barangays: ' . count($barangays));
        
        // Note: This seeder only provides the barangay list for the filter dropdown
        // No sample members are created - the system will use actual member data
    }
}
