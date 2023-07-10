<!DOCTYPE html>
<html>
<head>
    <title>New Posts Notification</title>
</head>
<body>
    <h1>New Posts</h1>

    <p>There are new posts available on our website. Please visit our website to view them.</p>

    <ul>
        @foreach ($posts as $post)
            <li>{{ $post->title }}</li>
        @endforeach
    </ul>
</body>
</html>
