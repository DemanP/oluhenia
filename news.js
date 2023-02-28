$(function() {
    $.post( "post-btn.php", function( data ) {
        console.log(data);
    
        if(data) {
            const post_btn = document.createElement("a");
            post_btn.innerHTML = "Post";
            post_btn.href = "post-news.html";
            document.getElementById("post-btn").appendChild(post_btn);
        }
    });

    $.post( "get-news.php", $(this).serializeArray(), function( data ) {
        console.log(data);

        data.forEach(news => {
            const news_title = document.createElement("label");
            news_title.innerHTML = news["title"];
            const news_text = document.createElement("pre");
            news_text.innerHTML = news["text"];
            const news_img = document.createElement("img");
            news_img.src = news["img_path"];
            news_img.style.cssText += "width: 25vw";

            const div = document.createElement("div");
            div.appendChild(document.createElement("hr"));
            div.appendChild(news_img);
            div.appendChild(document.createElement("br"));
            div.appendChild(news_title);
            div.appendChild(news_text);

            document.body.appendChild(div);
        });
    });
});

