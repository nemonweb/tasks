<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Сводка задач от {{{ $date }}}</h2>
<div>
    от <strong>{{ $name }} - {{ $email }}</strong>
</div>
<div>
    За эту неделю сделано:
</div>
<div>
    <ul>
        @foreach ($task as $item)
        <li>
            {{{ $item }}}
        </li>
        @endforeach
    </ul>
</div>
</body>
</html>