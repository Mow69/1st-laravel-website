require("./bootstrap");

$("#media").on("change", function() {
    var fileName = $(this).val();
    $(this)
        .next(".custom-file-label")
        .html(fileName);
    readURL(this);
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $("#preview")
                .html("")
                .append(
                    $(
                        "<div class='card' style='width: 18rem;'><img class='card-img-top' src='" +
                            e.target.result +
                            "'></div>"
                    )
                );
        };
        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}
