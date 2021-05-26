import React from "react";
import swal from "sweetalert2";
import { MdDelete } from "react-icons/md";
import confirmDelete from "./deleteConfirmDialogue";

const DeleteModal = (props) => {
  return (
    <div className="cursor-pointer">
      <MdDelete className="text-danger" size={18} onClick={() => confirmDelete(() => props.onConfirm())}></MdDelete>
    </div>
  );
};
export default DeleteModal;
