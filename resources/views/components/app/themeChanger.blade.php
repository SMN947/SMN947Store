<div class="form-control p-0 m-0">
    <select class="select select-bordered" id="theme" x-model="theme" x-on:change="document.documentElement.setAttribute('data-theme', theme)">
        <option value="dracula">Dracula</option>
        <option value="light">Light</option>
        <option value="dark">Dark</option>
        <option value="cupcake">Cupcake</option>
        <option value="black">Black</option>
        <option value="cyberpunk">Cyberpunk</option>
        <option value="retro">Retro</option>
    </select>
</div>