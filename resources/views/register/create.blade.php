<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10">
            <x-panel>
                <h1 class="text-center font-bold text-xl">Register</h1>
                <form action="{{ route('register.store') }}" method="POST">
                    @csrf

                    <x-form.input name="name"/>
                    <x-form.input name="username"/>
                    <x-form.input name="email" type="email"/>
                    <x-form.input name="password" type="password"/>


                    <div class="mb-6">
                        <input type="submit" class="hover:bg-blue-400 group flex items-center rounded-md bg-blue-500 text-white text-sm font-medium pl-2 pr-3 py-2 shadow-sm" value="submit">
                    </div>

                </form>
            </x-panel>
        </main>
    </section>
</x-layout>
