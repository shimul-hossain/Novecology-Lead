<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Super Admin Landing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
  
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <a onclick="event.preventDefault();this.closest('form').submit();" class="dropdown-item"
                        href="{{ route('logout') }}"><i class="mr-50" data-feather="power"></i> Logout</a>
                </form>
            
  
  
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh">
            <div class="col m-auto text-center">
                <button onclick="alert('CRM is under Development. Soon you will  be able to access the CRM');" type="button" class="btn btn-primary btn-lg">Go
                    To CRM</button>
                    
                @if (Auth::user()->role == 's_admin')
                <button onclick="event.preventDefault();window.location.href='{{ route('superadmin.dashboard') }}'"
                    class="btn btn-success btn-lg">Website Backend</button>
                @endif
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.slim.js" integrity="sha256-HwWONEZrpuoh951cQD1ov2HUK5zA5DwJ1DNUXaM6FsY=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
</body>

</html>
