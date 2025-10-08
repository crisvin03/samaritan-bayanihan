@extends('admin.layouts.app')

@section('title', 'Add New Member')
@section('page-title', 'Add New Member')
@section('page-description', 'Create a new member account')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Add New Member</h1>
                    <p class="text-gray-600 mt-2">Create a new member account for the system</p>
                </div>
                <a href="{{ route('admin.members.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Members
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
            <form method="POST" action="{{ route('admin.members.store') }}" class="p-8">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div class="md:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                        <input type="text" 
                               id="name" 
                               name="name" 
                               value="{{ old('name') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 @error('name') border-red-500 @enderror"
                               placeholder="Enter full name"
                               required>
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 @error('email') border-red-500 @enderror"
                               placeholder="Enter email address"
                               required>
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                        <input type="tel" 
                               id="phone_number" 
                               name="phone_number" 
                               value="{{ old('phone_number') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 @error('phone_number') border-red-500 @enderror"
                               placeholder="Enter phone number">
                        @error('phone_number')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password *</label>
                        <input type="password" 
                               id="password" 
                               name="password"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 @error('password') border-red-500 @enderror"
                               placeholder="Enter password"
                               required>
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password *</label>
                        <input type="password" 
                               id="password_confirmation" 
                               name="password_confirmation"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300"
                               placeholder="Confirm password"
                               required>
                    </div>

                    <!-- Barangay -->
                    <div>
                        <label for="barangay" class="block text-sm font-medium text-gray-700 mb-2">Barangay *</label>
                        <select id="barangay" 
                                name="barangay"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 @error('barangay') border-red-500 @enderror"
                                required>
                            <option value="">Select Barangay</option>
                            <option value="A. Bonifacio (Tinurilan)" {{ old('barangay') == 'A. Bonifacio (Tinurilan)' ? 'selected' : '' }}>A. Bonifacio (Tinurilan)</option>
                            <option value="Abad Santos (Kambal)" {{ old('barangay') == 'Abad Santos (Kambal)' ? 'selected' : '' }}>Abad Santos (Kambal)</option>
                            <option value="Aguinaldo (Lipata Dako)" {{ old('barangay') == 'Aguinaldo (Lipata Dako)' ? 'selected' : '' }}>Aguinaldo (Lipata Dako)</option>
                            <option value="Antipolo" {{ old('barangay') == 'Antipolo' ? 'selected' : '' }}>Antipolo</option>
                            <option value="Aquino (Imelda)" {{ old('barangay') == 'Aquino (Imelda)' ? 'selected' : '' }}>Aquino (Imelda)</option>
                            <option value="Bical" {{ old('barangay') == 'Bical' ? 'selected' : '' }}>Bical</option>
                            <option value="Beguin" {{ old('barangay') == 'Beguin' ? 'selected' : '' }}>Beguin</option>
                            <option value="Bonga" {{ old('barangay') == 'Bonga' ? 'selected' : '' }}>Bonga</option>
                            <option value="Butag" {{ old('barangay') == 'Butag' ? 'selected' : '' }}>Butag</option>
                            <option value="Cadandanan" {{ old('barangay') == 'Cadandanan' ? 'selected' : '' }}>Cadandanan</option>
                            <option value="Calomagon" {{ old('barangay') == 'Calomagon' ? 'selected' : '' }}>Calomagon</option>
                            <option value="Calpi" {{ old('barangay') == 'Calpi' ? 'selected' : '' }}>Calpi</option>
                            <option value="Cocok-Cabitan" {{ old('barangay') == 'Cocok-Cabitan' ? 'selected' : '' }}>Cocok-Cabitan</option>
                            <option value="Daganas" {{ old('barangay') == 'Daganas' ? 'selected' : '' }}>Daganas</option>
                            <option value="Danao" {{ old('barangay') == 'Danao' ? 'selected' : '' }}>Danao</option>
                            <option value="Dolos" {{ old('barangay') == 'Dolos' ? 'selected' : '' }}>Dolos</option>
                            <option value="E. Quirino (Pinangomhan)" {{ old('barangay') == 'E. Quirino (Pinangomhan)' ? 'selected' : '' }}>E. Quirino (Pinangomhan)</option>
                            <option value="Fabrica" {{ old('barangay') == 'Fabrica' ? 'selected' : '' }}>Fabrica</option>
                            <option value="G. Del Pilar (Tanga)" {{ old('barangay') == 'G. Del Pilar (Tanga)' ? 'selected' : '' }}>G. Del Pilar (Tanga)</option>
                            <option value="Gate" {{ old('barangay') == 'Gate' ? 'selected' : '' }}>Gate</option>
                            <option value="Inararan" {{ old('barangay') == 'Inararan' ? 'selected' : '' }}>Inararan</option>
                            <option value="J. Gerona (Biton)" {{ old('barangay') == 'J. Gerona (Biton)' ? 'selected' : '' }}>J. Gerona (Biton)</option>
                            <option value="J.P. Laurel (Pon-od)" {{ old('barangay') == 'J.P. Laurel (Pon-od)' ? 'selected' : '' }}>J.P. Laurel (Pon-od)</option>
                            <option value="Jamorawon" {{ old('barangay') == 'Jamorawon' ? 'selected' : '' }}>Jamorawon</option>
                            <option value="Libertad (Calle Putol)" {{ old('barangay') == 'Libertad (Calle Putol)' ? 'selected' : '' }}>Libertad (Calle Putol)</option>
                            <option value="Lajong" {{ old('barangay') == 'Lajong' ? 'selected' : '' }}>Lajong</option>
                            <option value="Magsaysay (Bongog)" {{ old('barangay') == 'Magsaysay (Bongog)' ? 'selected' : '' }}>Magsaysay (Bongog)</option>
                            <option value="Managa-naga" {{ old('barangay') == 'Managa-naga' ? 'selected' : '' }}>Managa-naga</option>
                            <option value="Marinab" {{ old('barangay') == 'Marinab' ? 'selected' : '' }}>Marinab</option>
                            <option value="Nasuje" {{ old('barangay') == 'Nasuje' ? 'selected' : '' }}>Nasuje</option>
                            <option value="Montecalvario" {{ old('barangay') == 'Montecalvario' ? 'selected' : '' }}>Montecalvario</option>
                            <option value="N. Roque (Calayugan)" {{ old('barangay') == 'N. Roque (Calayugan)' ? 'selected' : '' }}>N. Roque (Calayugan)</option>
                            <option value="Namo" {{ old('barangay') == 'Namo' ? 'selected' : '' }}>Namo</option>
                            <option value="Obrero" {{ old('barangay') == 'Obrero' ? 'selected' : '' }}>Obrero</option>
                            <option value="Osmeña (Lipata Saday)" {{ old('barangay') == 'Osmeña (Lipata Saday)' ? 'selected' : '' }}>Osmeña (Lipata Saday)</option>
                            <option value="Otavi" {{ old('barangay') == 'Otavi' ? 'selected' : '' }}>Otavi</option>
                            <option value="Padre Diaz" {{ old('barangay') == 'Padre Diaz' ? 'selected' : '' }}>Padre Diaz</option>
                            <option value="Palale" {{ old('barangay') == 'Palale' ? 'selected' : '' }}>Palale</option>
                            <option value="Quezon (Cabarawan)" {{ old('barangay') == 'Quezon (Cabarawan)' ? 'selected' : '' }}>Quezon (Cabarawan)</option>
                            <option value="R. Gerona (Butag)" {{ old('barangay') == 'R. Gerona (Butag)' ? 'selected' : '' }}>R. Gerona (Butag)</option>
                            <option value="Recto" {{ old('barangay') == 'Recto' ? 'selected' : '' }}>Recto</option>
                            <option value="Roxas (Busay)" {{ old('barangay') == 'Roxas (Busay)' ? 'selected' : '' }}>Roxas (Busay)</option>
                            <option value="Sagrada" {{ old('barangay') == 'Sagrada' ? 'selected' : '' }}>Sagrada</option>
                            <option value="San Francisco (Polot)" {{ old('barangay') == 'San Francisco (Polot)' ? 'selected' : '' }}>San Francisco (Polot)</option>
                            <option value="San Isidro (Cabugaan)" {{ old('barangay') == 'San Isidro (Cabugaan)' ? 'selected' : '' }}>San Isidro (Cabugaan)</option>
                            <option value="San Juan Bag-o" {{ old('barangay') == 'San Juan Bag-o' ? 'selected' : '' }}>San Juan Bag-o</option>
                            <option value="San Juan Daan" {{ old('barangay') == 'San Juan Daan' ? 'selected' : '' }}>San Juan Daan</option>
                            <option value="San Rafael (Togbongon)" {{ old('barangay') == 'San Rafael (Togbongon)' ? 'selected' : '' }}>San Rafael (Togbongon)</option>
                            <option value="San Ramon" {{ old('barangay') == 'San Ramon' ? 'selected' : '' }}>San Ramon</option>
                            <option value="San Vicente" {{ old('barangay') == 'San Vicente' ? 'selected' : '' }}>San Vicente</option>
                            <option value="Santa Remedios" {{ old('barangay') == 'Santa Remedios' ? 'selected' : '' }}>Santa Remedios</option>
                            <option value="Santa Teresita (Trece)" {{ old('barangay') == 'Santa Teresita (Trece)' ? 'selected' : '' }}>Santa Teresita (Trece)</option>
                            <option value="Sigad" {{ old('barangay') == 'Sigad' ? 'selected' : '' }}>Sigad</option>
                            <option value="Somagongsong" {{ old('barangay') == 'Somagongsong' ? 'selected' : '' }}>Somagongsong</option>
                            <option value="Tarhan" {{ old('barangay') == 'Tarhan' ? 'selected' : '' }}>Tarhan</option>
                            <option value="Taromata" {{ old('barangay') == 'Taromata' ? 'selected' : '' }}>Taromata</option>
                            <option value="Zone 1 (Ilawod)" {{ old('barangay') == 'Zone 1 (Ilawod)' ? 'selected' : '' }}>Zone 1 (Ilawod)</option>
                            <option value="Zone 2 (Sabang)" {{ old('barangay') == 'Zone 2 (Sabang)' ? 'selected' : '' }}>Zone 2 (Sabang)</option>
                            <option value="Zone 3 (Central)" {{ old('barangay') == 'Zone 3 (Central)' ? 'selected' : '' }}>Zone 3 (Central)</option>
                            <option value="Zone 4 (Central Business District)" {{ old('barangay') == 'Zone 4 (Central Business District)' ? 'selected' : '' }}>Zone 4 (Central Business District)</option>
                            <option value="Zone 5 (Canipaan)" {{ old('barangay') == 'Zone 5 (Canipaan)' ? 'selected' : '' }}>Zone 5 (Canipaan)</option>
                            <option value="Zone 6 (Baybay)" {{ old('barangay') == 'Zone 6 (Baybay)' ? 'selected' : '' }}>Zone 6 (Baybay)</option>
                            <option value="Zone 7 (Iraya)" {{ old('barangay') == 'Zone 7 (Iraya)' ? 'selected' : '' }}>Zone 7 (Iraya)</option>
                            <option value="Zone 8 (Loyo)" {{ old('barangay') == 'Zone 8 (Loyo)' ? 'selected' : '' }}>Zone 8 (Loyo)</option>
                        </select>
                        @error('barangay')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Gender -->
                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                        <select id="gender" 
                                name="gender"
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 @error('gender') border-red-500 @enderror">
                            <option value="">Select Gender</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('gender')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Birth Date -->
                    <div>
                        <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-2">Birth Date</label>
                        <input type="date" 
                               id="birth_date" 
                               name="birth_date" 
                               value="{{ old('birth_date') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 @error('birth_date') border-red-500 @enderror">
                        @error('birth_date')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Occupation -->
                    <div>
                        <label for="occupation" class="block text-sm font-medium text-gray-700 mb-2">Occupation</label>
                        <input type="text" 
                               id="occupation" 
                               name="occupation" 
                               value="{{ old('occupation') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 @error('occupation') border-red-500 @enderror"
                               placeholder="Enter occupation">
                        @error('occupation')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div class="md:col-span-2">
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                        <textarea id="address" 
                                  name="address" 
                                  rows="3"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-300 @error('address') border-red-500 @enderror"
                                  placeholder="Enter full address">{{ old('address') }}</textarea>
                        @error('address')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.members.index') }}" 
                       class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-medium rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        Create Member
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
