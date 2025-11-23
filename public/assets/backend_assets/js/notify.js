export const showNotice = (data) => {
  const {
    title = "Alert Title",
    text = "Alert Text",
    type = "notice",
    positionX = "left",
    positionY = "down",
    up100 = false,
    down75 = false,
  } = data;

  const defaultStack = new PNotify.Stack({
    dir1: positionX,
    dir2: positionY,
    firstpos1: 25,
    firstpos2: 25,
    spacing1: 36,
    spacing2: 36,
    push: "bottom",
    context: document.body,
  });

  const stackBarTop = new PNotify.Stack({
    modal: false,
    dir1: "down",
    firstpos1: 0,
    spacing1: 0,
    push: "top",
    maxOpen: Infinity,
  });

  const stackBarBottom = new PNotify.Stack({
    dir1: "up",
    firstpos1: 0,
    spacing1: 0,
  });

  let alertClass = "alert-primary";
  if (type === "info") alertClass = "alert-info";
  else if (type === "error") alertClass = "alert-danger";
  else if (type === "success") alertClass = "alert-success";
  else if (type === "warning") alertClass = "alert-warning";

  const alertArg = {
    title: title,
    text: text,
    type: type,
    addClass: `${alertClass} ui-pnotify-no-icon ${
      up100 ? "stack-bar-top" : down75 ? "stack-bar-bottom" : ""
    }`,
    mode: "no-preference",
    delay: 40000,
    stack: up100 ? stackBarTop : down75 ? stackBarBottom : defaultStack,
    width: up100 || down75 ? "100%" : "360px",
  };

  PNotify.alert(alertArg);
};

const alertClasses = {
  popup: "alert-popup-bg",
  header: "alert-header",
  title: "alert-title",
  closeButton: "alert-close-btn",
  icon: "alert-icon",
  image: "alert-image",
  htmlContainer: "alert-text-container",
  input: "alert-input",
  inputLabel: "alert-input-label",
  confirmButton: "alert-confirm-btn",
  denyButton: "alert-deny-btn",
  cancelButton: "alert-cancel-btn",
  loader: "alert-loader",
  footer: "alert-footer",
};

export const showAlert = (data = {}) => {
  const {
    title = "alert title",
    text = " alert Text",
    type = "success",
    position = "center",
    cancelBtn= false
  } = data;

 const result =  Swal.fire({
    title: title,
    text: text,
    icon: type,
    position: position,
    confirmButtonText: "Ok",
    showCancelButton: cancelBtn,
    cancelButtonText: "Cancel",
    customClass: alertClasses,
    buttonsStyling: false,
 });
  
  return result
};


export const AlertWithInput = ({data = {}}) => {
  const {
    title = "alert title",
    text = " alert Text",
    type = "none",
    position = "center",
    cancelBtn = true,
    inputType = "text"
  } = data;

  const result =  Swal.fire({
    title: title,
    text: text,
    icon: type,
    position: position,
    confirmButtonText: "Ok",
    showCancelButton: cancelBtn,
    cancelButtonText: "Cancel",
    customClass: alertClasses,
    buttonsStyling: false,
    input:inputType,
 });
  
  return result
  
}