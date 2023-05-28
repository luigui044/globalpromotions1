<x-guest-layout>

    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
          <img class="mx-auto h-20 w-auto" src="{{ asset('img/logo-negro.png') }}" alt="Global-Promotions">
          <h2 class="mt-2 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Registra tu cuenta</h2>
        </div>
      
        <div class="mt-2 sm:mx-auto sm:w-full sm:max-w-sm">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-2" :errors="$errors" />
            <form class="space-y-6" action="{{ route('register') }}" method="POST">
                @csrf
                <div>
                    <label for="name" :value="__('Name')"  class="block text-sm font-medium leading-6 text-gray-900">Nombre completo</label>
                    <div class="mt-1">
                    <input id="name" name="name" type="text" autocomplete="name" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="email"  :value="__('Email')" class="block text-sm font-medium leading-6 text-gray-900">Dirección de correo</label>
                        <div class="mt-1">
                            <input id="email" name="email" type="email" autocomplete="email"  required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="phone"   class="block text-sm font-medium leading-6 text-gray-900">Teléfono</label>
                        <div class="mt-1">
                            <input id="phone" name="phone" type="text" autocomplete="phone"  required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                  
                </div>
               
                <div>
                    <label for="password" :value="__('Password')" class="block text-sm font-medium leading-6 text-gray-900">Contraseña</label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div>
                    <label for="password_confirmation" :value="__('Confirm Password')" class="block text-sm font-medium leading-6 text-gray-900">Contraseña</label>
                    <div class="mt-1">
                    <input id="password_confirmation" type="password" name="password_confirmation"  autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>
                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Registrarme</button>
                </div>
          </form>
      
            <p class="mt-2 text-center text-sm text-gray-500">
                ¿Ya tienes cuenta?
                <a href="{{ route('login') }}" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Inicia sesión</a>
            </p>
        </div>
    </div>


</x-guest-layout>
