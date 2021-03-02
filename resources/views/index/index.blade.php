<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <th>ID</th>
            <th>用户名</th>
            <th>密码</th>
            <th>操作</th>
        </tr>
        @foreach($user as $v)
        <tr>
            <td>{{$v->user_id}}</td>
            <td>{{$v->user_name}}</td>
            <td>{{$v->user_pass}}</td>
            <td><a href="/index/edit/{{$v->user_id}}">修改</a>|<a href="#">删除</a></td>
        </tr>
        @endforeach
    </table>
</body>
</html>