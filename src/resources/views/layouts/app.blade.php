<x-layouts.app :title="$title">
    <div class="container">
        <header>
            <x-navs.top-navigation />
        </header>
        <div class="content">  
            <main>
                @yield('content')
            </main>
        </div>
        <footer class="main-footer">
            <p>&copy; 2025 Tickets to the Dream!</p>
        </footer>
    </div>
    
    <script>
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.calendar-container') 
            && !event.target.closest('.open-calendar') 
            && !event.target.closest('.open-counter')
            && !event.target.closest('.counter-container')
         ) {
                console.log(event.target);
                Livewire.dispatch('closeModals');
            }
        });
    </script>

</x-layouts.app>