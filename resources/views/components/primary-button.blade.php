<button {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-primary hover:bg-accent text-white font-semibold py-2 px-4 rounded shadow']) }}>
    {{ $slot }}
</button>
