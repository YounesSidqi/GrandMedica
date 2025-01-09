<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - GrandMedica</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 bg-[url('{{ asset('assets/img/bg-login.png') }}')] bg-cover bg-center">
  <div class="min-h-screen flex flex-col justify-center items-center bg-opacity-80">
      <!-- Back Button -->
      <a href="/" class="absolute top-4 left-4 flex items-center text-green-800 hover:text-green-600">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
          <span class="font-semibold">Kembali</span>
      </a>

      <div class="text-center mb-8">
          <img src="{{ asset('assets/img/logogrand.png') }}" alt="GrandMedica Logo" class="mx-auto w-40 h-auto">
          <h1 class="text-3xl font-semibold text-green-800 mt-4">Selamat datang di website GrandMedica</h1>
      </div>
      <div class="bg-green-800 p-8 rounded-lg shadow-lg text-white w-120 h-auto">
          <h2 class="text-2xl font-bold mb-4 text-center">Login</h2>
          <p class="text-sm mb-6 text-center">
              Tolong isi kolom di bawah ini untuk melakukan login. <br>
              Akses login hanya bisa dilakukan untuk Admin dan Moderator saja.
          </p>
          @if ($errors->any())
            <div class="p-4 mb-4 text-sm text-white rounded-lg bg-green-900 dark:bg-green-400 dark:text-black font-medium" role="alert">
              <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
              </ul>
            </div>
        @endif
          <form action="" method="POST">
              @csrf
              <div class="mb-4">
                  <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="w-full p-3 rounded bg-green-700 text-white placeholder-white focus:outline-none focus:ring-2 focus:ring-green-600">
              </div>
              <div class="mb-6">
                  <input type="password" name="password" value="{{ old('password ') }}" placeholder="Password" class="w-full p-3 rounded bg-green-700 text-white placeholder-white focus:outline-none focus:ring-2 focus:ring-green-600">
              </div>
              <button type="submit" class="w-full bg-green-700 hover:bg-green-500 text-white py-3 rounded font-semibold ">Login</button>
          </form>
      </div>
  </div>
</body>
</html>
