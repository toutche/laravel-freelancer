<h1>Olá, {{ $user->name }}</h1>

<p>
	Por favor click no link abaixo para resetar sua senha!

	<a href="laravel.dev/perfil/resetar/senha/{{ $token }}">Click aqui</a>
</p>