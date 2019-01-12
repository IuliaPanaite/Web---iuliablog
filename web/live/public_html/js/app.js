function deletePost(id) {
    if (confirm("Want to delete?"))
        $.ajax({
            url: '/delete/' + id,
            type: 'DELETE',
            success: function (result) {
                window.location.href = '/';
            }
        });
}

function addPost() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("table").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "../ajax/add.html", true);
    xhttp.send();
}

function getAll() {
    window.location.href = '/';
}

function mySubmitFunction(e) {
    e.preventDefault();
    return false;
}

function create() {
    var title = document.getElementById('title').value;
    var author = document.getElementById('author').value;
    var content = document.getElementById('content').value;
    // console.log(title);
    // console.log(author);
    // console.log(content);

    // var post = [];
    // post.push(title);
    // post.push(author);
    // post.push(content);
    // console.log(post);

    $.ajax({
        url: "/add-post",
        type: "POST",
        data: ({'title': title, 'author': author, 'content': content}),
        dataType: "json",
        success: function (result) {
            window.location.href = '/';
        }
    });
}

function changeFavorite(id, val) {
    $.ajax({
        url: "/changeFavorite",
        type: "PUT",
        data: ({'id': id, 'val': val}),
        dataType: "json",
        success: function (result) {
            window.location.href = '/';
        }
    });
}

function seeContent(id) {
    $.ajax({
        url: "/getContent",
        type: "GET",
        data: ({'id': id}),
        dataType: "json",
        success: function (result) {
            window.location.href = '/blog';
        }
    });

}