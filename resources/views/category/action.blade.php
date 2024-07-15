<div class="d-flex">
    <a href="{{ route('category.edit', $model) }}" class="btn btn-warning btn-sm mx-1">Edit</a>

    <form action="" method="post" id="deleteForm">
        @csrf
        @method('DELETE')
        <button href="{{ route('category.destroy', $model) }}"
        class="btn btn-danger btn-sm" id="delete">Delete</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).on('click', '#delete', function(e) {
        e.preventDefault()

        const href = $(this).attr('href');

        console.log("btn delete click");

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm').action = href;
                document.getElementById('deleteForm').submit();
                Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success"
                });
            }
        });
    });
</script>
