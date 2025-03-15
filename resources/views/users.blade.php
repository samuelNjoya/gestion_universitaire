<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>


    <title>Document</title>
</head>
<body>
    <h1 class="text-center">PDF Download</h1>
    {{-- {{ $title }} --}}
    <span>Date: {{ $date }}</span>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    {{-- <th>Picture</th> --}}
                    <th>Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    {{-- <td >
                        @if (!empty($item->getProfile()))
                            <img style="border-radius: 50%" width="60px" height="60px"  src="{{ $item->getProfile() }}" alt="">
                        @endif
                    </td> --}}
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->gender }}</td>
                    <td>{{ $item->address }}</td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
</body>
</html>