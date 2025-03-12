<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Tasker</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

  <!-- Styles / Scripts -->
  @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  @endif
</head>

<body class="bg-white text-gray-900 flex flex-col min-h-screen">
  <header class="w-full bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center py-6">
        <div class="flex-shrink-0">
          <a href="{{ url('/') }}" class="text-2xl font-bold text-primary">
            <x-application-logo />
        </a>
        </div>
        <nav class="flex items-center space-x-4">
          @if (Route::has('login'))
            @auth
              <a href="{{ url('/tasks') }}" class="text-md font-medium text-gray-700">Tasks</a>
            @else
              <a href="{{ route('login') }}" class="text-md font-medium text-gray-700">Log in</a>
            @endauth
          @endif
        </nav>
      </div>
    </div>
  </header>

  <main class="flex-grow">
    <div class="bg-white">
      <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 text-center">
        <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
          <span class="block">Stay Organized and Productive</span>
          <span class="block text-primary">Manage Your Tasks Efficiently</span>
        </h2>
        <div class="mt-8 flex justify-center">
          <div class="inline-flex rounded-md shadow">
            <a href="{{ route('register') }}"
              class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary hover:bg-accent">
              Get Started
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="bg-gray-50 py-12">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
          <h2 class="text-base text-primary font-semibold tracking-wide uppercase">Why Choose Task App?</h2>
          <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
            Solve Common Productivity Problems
          </p>
        </div>

        <div class="mt-10">
          <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-1 md:gap-x-8 md:gap-y-10">
            <div class="relative">
              <dt>
                <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-primary text-white">
                  <i class="bx bx-time text-2xl"></i>
                </div>
                <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Time Management</p>
              </dt>
              <dd class="mt-2 ml-16 text-base text-gray-600">
                Struggling to keep track of your tasks and deadlines? Task App helps you manage your time effectively.
              </dd>
            </div>

            <div class="relative">
              <dt>
                <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-primary text-white">
                  <i class="bx bx-check-circle text-2xl"></i>
                </div>
                <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Task Completion</p>
              </dt>
              <dd class="mt-2 ml-16 text-base text-gray-600">
                Finding it hard to complete tasks on time? Task App keeps you focused and on track to meet your goals.
              </dd>
            </div>

            <div class="relative">
              <dt>
                <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-primary text-white">
                  <i class="bx bx-group text-2xl"></i>
                </div>
                <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Team Collaboration</p>
              </dt>
              <dd class="mt-2 ml-16 text-base text-gray-600">
                Need to collaborate with your team? Task App makes it easy to assign tasks and work together
                efficiently.
              </dd>
            </div>
          </dl>
        </div>
      </div>
    </div>
  </main>
</body>

</html>
