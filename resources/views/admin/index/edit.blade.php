<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{url('index/update')}}" method="post">
    {{csrf_field()}}
        <table>
        <input type="hidden" name='user_id' value="{{$user->user_id}}">
            <tr>
                <td>用户名:</td>
                <td><input type="text" name="user_name" value="{{$user->user_name}}"></td>
            </tr>
            <tr>
                <td><input type="submit" value="提交"></td>
            </tr>
        </table>
    </form>
</body>
</html>