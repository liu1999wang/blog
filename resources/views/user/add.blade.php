<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="{{url('user/store')}}" method="post">
        <table>
        {{csrf_field()}}
            <tr>
            
                <td>user</td>
                <td><input type="text" name="username"></td>
            </tr>
            <tr><td>pass</td>
            <td><input type="password" name="password"></td></tr>
            <tr><td><input type="submit" value="提交"></td></tr>
        </table>
    </form>
</body>
</html>