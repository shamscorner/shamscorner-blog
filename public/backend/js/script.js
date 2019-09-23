function approvePost(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "You want to approve this post!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, approve it!"
    }).then(result => {
        if (result.value) {
            event.preventDefault();
            document.getElementById("approval-form-" + id).submit();
        }
    });
}

function disApprovePost(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "You want to disapprove this post!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, disapprove it!"
    }).then(result => {
        if (result.value) {
            event.preventDefault();
            document.getElementById("disapproval-form-" + id).submit();
        }
    });
}

function deletePost(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then(result => {
        if (result.value) {
            event.preventDefault();
            document.getElementById("delete-form-" + id).submit();
        }
    });
}
