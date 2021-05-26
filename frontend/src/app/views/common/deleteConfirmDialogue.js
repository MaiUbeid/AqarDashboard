import swal from "sweetalert2";

function deleteConfirm(confirmationCallback, message = "لا يمكن التراجع عن هذه العملية...", ishtml = false) {
  swal
    .fire({
      title: "هل أنت متأكد؟",
      text: message,
      html: ishtml && message,
      icon: "warning",
      type: "question",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "موافق",
      cancelButtonText: "لا",
    })
    .then((result) => {
      if (result.value) {
        confirmationCallback();
      } else {
        // swal.fire({
        //   title: "Cancelled!",
        //   text: "Deletion aborted",
        //   type: "error",
        //   icon: "error",
        //   timer: 800
        // });
      }
    });
}

export default deleteConfirm;
