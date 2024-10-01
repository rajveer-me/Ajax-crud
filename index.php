<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD with AJAX</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Create Post</h1>
    <form id="postForm" enctype="multipart/form-data">
        <input type="hidden" name="id" id="postId">
        <input type="text" name="title" placeholder="Post Title" required><br>
            <select name="post_type" required>
                <option value="">Select Post Type</option>
                <option value="education">Education</option>
                <option value="blog">Blog</option>
                <option value="career">Career</option>
            </select><br>
        <input type="file" name="image" ><br>
        <textarea name="comment" placeholder="Post Comment" required></textarea><br>
        <button type="submit">Submit</button>
    </form>

    <h2>Posts List</h2>
    <table id="postList" border="1">
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Type</th>
                <th>Image</th>
                <th>Comment</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <script>
        $(document).ready(function() {
            function loadPosts() {
                $.ajax({
                    url: 'fetch_posts.php',
                    method: 'GET',
                    success: function(data) {
                        $('#postList tbody').html(data);
                    }
                });
            }

            loadPosts(); // Load posts on page load

            // Create a Post
            $('#postForm').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                var actionUrl = $('#postId').val() ? 'update_post.php' : 'create_post.php';

                $.ajax({
                    url: actionUrl,
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        loadPosts(); // Refresh post list
                        $('#postForm')[0].reset(); // Reset the form
                    }
                });
            });

            // Load post for editing
            $(document).on('click', '.edit-btn', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: 'fetch_post.php',
                    method: 'GET',
                    data: { id: id },
                    dataType: 'json',
                    success: function(data) {
                        $('#postId').val(data.id);
                        $('input[name="title"]').val(data.title);
                        $('select[name="post_type"]').val(data.post_type);
                        $('textarea[name="comment"]').val(data.comment);
                    }
                });
            });

            // Delete post
            $(document).on('click', '.delete-btn', function() {
                var id = $(this).data('id');
                if (confirm('Are you sure you want to delete this post?')) {
                    $.ajax({
                        url: 'delete_post.php',
                        method: 'POST',
                        data: { id: id },
                        success: function(response) {
                            loadPosts(); // Refresh post list
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
