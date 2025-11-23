
import { AlertWithInput, showAlert, showNotice } from "./notify.js";



$(document).ready(function () {

  $('[data-bs-toggle="tooltip"]').tooltip();
  $(".dropdown-toggle").dropdown();
  
  // -------------------------------------- theme switch setting --------------------------------------
  const _body = $("body");
  const theme_switch_input = $(".theme-switch-input");
  const theme = localStorage.getItem("theme");


  if (theme === "dark") {
    _body.addClass("dark").removeClass("light");
    theme_switch_input.attr("checked", true);
  } else {
    _body.addClass("light").removeClass("dark")
  }
  
// the setting function 
  theme_switch_input.on("change",function (e) {
    const value = e.target.checked;
    const ball = $(".theme-change-switch label .ball");

    if (value) {
      _body.addClass("dark").removeClass("light");
      ball.addClass("ball-checked").removeClass("ball-unchecked")
      localStorage.setItem("theme", "dark");
    } else {
      _body.addClass("light").removeClass("dark");
      ball.removeClass("ball-checked").addClass("ball-unchecked")
      localStorage.setItem("theme", "light");
    }
  });
 // -------------------------------------- theme switch setting --------------------------------------




  // ############################ sidebar javascript start here   #################

  const sidebar_main = $(".sidebar-main");
  const sidebar_sub_menu = $(".sidebar_sub-menu");
  const sidebar_subSub_menu = $(".sidebar_subsub-menu");
  const sidebarSize = localStorage.getItem("sidebar-size");

  // sidebar initial setting 
  if (sidebarSize === "sm" && _body.width() > 992) {
    sidebar_main.addClass("sidebar-main-sm");
  }
  if ($(window).width() < 992) {
    sidebar_main.addClass("sidebar-main-xs");
    $(".uv-nav-collapse").slideUp(20);
  }
  $(".main__header__collapse-btn").on("click", function () {
    $(".main__header__collapse").slideToggle(300);
  });

  sidebar_main.on("blur", function () {
  console.log("blur")
})

  // sidebar toggle button click event handler 
  $(".sidebar-toggle-btn").on("click", function () {
    const sidebarSize = localStorage.getItem("sidebar-size");
    if ($("body").width() > 992) {
      if (sidebarSize === "sm") {
        localStorage.setItem("sidebar-size", "lg");
      } else {
        localStorage.setItem("sidebar-size", "sm");
      }
    }
  });


  // sidebar mouse in and out handler 
  sidebar_main.on("mouseenter", function () {
    $(this).removeClass("sidebar-main-sm");
  });
  sidebar_main.on("mouseleave",function () {
    const sidebarSize = localStorage.getItem("sidebar-size");
    if (sidebarSize === "sm" && $("body").width() > 992) {
      sidebar_main.addClass("sidebar-main-sm");
      $(".sidebar_sub-menu").hide();
    }
  });


  // sidebar sub menu hide show function 
  sidebar_sub_menu.slideUp();
  sidebar_subSub_menu.slideUp();

  $(".sidebar_main-menu .main-nav-link").on("click", function () {
    const _this = $(this);

    sidebar_sub_menu.removeClass("open");
    _this.children(".sidebar-arrow").toggleClass("fa-rotate-90");
    _this.next(".sidebar_sub-menu").slideToggle(300);
    _this.addClass("menu-open");
    _this.next(".sidebar_sub-menu").addClass("open");

    sidebar_sub_menu.not(".open").slideUp(300);
    sidebar_sub_menu.not(".open").prev(".nav-link").removeClass("menu-open");
    sidebar_sub_menu.not(".open").prev(".main-nav-link").children(".sidebar-arrow").removeClass("fa-rotate-90");
  });


// sidebar sub sub menu hide show function 
  $(".sidebar_sub-menu .sub-nav-link").on("click", function () {
    const _this = $(this);

    sidebar_subSub_menu.removeClass("open");
   _this.children(".sidebar-arrow").toggleClass("fa-rotate-90");
   _this.next(".sidebar_subsub-menu").slideToggle(300);
   _this.next(".sidebar_subsub-menu").addClass("open");
    
   sidebar_subSub_menu.not(".open").slideUp(300);
   sidebar_subSub_menu.not(".open").prev(".sub-nav-link").children(".sidebar-arrow").removeClass("fa-rotate-90");
  });



// window reside for responsive layout 
  $(window).on("resize", function () {
    const sidebarSize = localStorage.getItem("sidebar-size");
    if ($(window).width() > 992) {
      $(".uv-nav-collapse").slideDown(20);
      if (sidebarSize === "sm") {
       sidebar_main.addClass("sidebar-main-sm").removeClass("sidebar-main-xs");
      } else {
        sidebar_main.removeClass("sidebar-main-sm sidebar-main-xs");
      }
    } else {
      sidebar_main.addClass("sidebar-main-xs").removeClass("sidebar-main-sm");
      $(".uv-nav-collapse").slideUp(20);
    }

    if ($(window).width() < 768) {
      $(".main__header__collapse").slideUp(300);
    }
   

  });


  // small device sidebar toggle function 
  $(".sidebar-close-btn").on("click", function () {
   sidebar_main.addClass("sidebar-main-xs");
  });
  $(".sidebar-open-btn").on("click", function () {
    sidebar_main.removeClass("sidebar-main-xs");
  });
  $(".uv-nav-collapse-btn").on("click",function () {
    $(".uv-nav-collapse").slideToggle(300);
  });

  // ############################ sidebar javascript end here   #################





  // ########################################  javascript for summer note  start here ###########################
  //                      ########################################   ###########################
  $("#notepad_default").summernote({ minHeight: "400px",});
  


  //  summer note fixed height
  $("#notepad_fixed_height").summernote({ height: "350px" });
  


  // summer note air
  $("#notepad_air").summernote({
    tabsize: 2,
    airMode: true,
  });

  $(".click-to-edit-btn").on("click", function () {
    $("#click_to_edit").summernote({focus:true})
  })

  $(".click-to-save-btn").on("click", function () {
    const markup = $("#click_to_edit").summernote("code")
    $("#click_to_edit").summernote("destroy")
  })

  // ########################################  javascript for summer note  end here ###########################
  //                      ########################################   ###########################





  // #######################################  data table js start ##########################################
    //  #######################################################################################################
  
  
  const _dt_dom_default = "<'row pb-3 pt-2 g-3 _data_table-header'<'col-12 col-sm-6 col-xl-4 align-items-center' f> <'col-12 col-sm-6 col-xl-2 d-xl-none'l> <'col-12 col-xl-5'<'dataTable_btn-group'B>> <'col-12 d-none d-xl-block col-xl-3'l>>" +
    "<'row'<'col-12'tr>>" +
    "<'row pt-3'<'col-12 col-sm-5'i><'col-12 col-sm-7'p>>";

  const _dt_dom_without_export =
  "<'row pb-3 pt-2 g-3 _data_table-header'<'col-12 col-sm-6 col-xl-6 align-items-center' f>  <'col-12 col-sm-6 col-xl-6'l>>" +
  "<'row'<'col-12'tr>>" +
  "<'row pt-3'<'col-12 col-sm-5'i><'col-12 col-sm-7'p>>";

const _dt_dom_without_filter =
  "<'row pb-3 pt-2 g-3 _data_table-header'<'col-12 col-sm-6 col-xl-6'<'dataTable_btn-group start'B>>  <'col-12 col-sm-6 col-xl-6'l>>" +
  "<'row'<'col-12'tr>>" +
    "<'row pt-3'<'col-12 col-sm-5'i><'col-12 col-sm-7'p>>";
  
  const _dt_breakpoint_option = [
    {name: 'bigdesktop', width: Infinity},
    {name: 'meddesktop', width: 1480},
    {name: 'smalldesktop', width: 1280},
    {name: 'medium', width: 1188},
    {name: 'tabletl', width: 1024},
    {name: 'btwtabllandp', width: 848},
    {name: 'tabletp', width: 768},
    {name: 'mobilel', width: 480},
    {name: 'mobilep', width: 320}
  ]

  const _dt_language_option = {
    searchPlaceholder: "Type to filter",
    search: "<span class='dt-lang-text '>Filter :</span> ",
    zeroRecords: "Nothing found - sorry",
    info: "<span class=' dt-lang-text'>Showing page _PAGE_ of _PAGES_</span>",
    infoEmpty: "No records available",
    infoFiltered: "(filtered from _MAX_ total records)",
    lengthMenu: "<span class='dt-lang-text'>Show :</span>  _MENU_",
    loadingRecords: "Loading...",
    paginate: {
      first: "First",
      last: "Last",
      next: "<i class='fa-solid fa-arrow-right-long'></i>",
      previous: "<i class='fa-solid fa-arrow-left-long'></i>",
    },
  }

  const _dt_button_list = [
    {
      extend: "copy",
      text: "Copy",
      exportOptions: {columns: ":visible"},
    },
    {
      extend: "csv",
      text: "CSV",
      exportOptions: {columns: ":visible"},
    },
    {
      extend: "excel",
      text: "Excel",
      exportOptions: {columns: ":visible"},
    },
    {
      extend: "pdf",
      text: "PDF",
      exportOptions: {columns: ":visible"},
    },
    {
      extend: "print",
      text: "Print",
      exportOptions: {columns: ":visible"},
    },
  ]



 const dataTableDefaultOption = {
    dom: _dt_dom_default,
    paging: true,
    lengthMenu: [5, 10, 15, 25, 50],
    autoWidth: true,
    responsive: _dt_breakpoint_option,
    language: _dt_language_option,
    buttons: _dt_button_list,
  };
  
  
    // default data table initialization
  $.extend($.fn.dataTable.defaults, dataTableDefaultOption)

    $(".table_default").DataTable();
  
    //  data table without export initialization
  $(".table-without-export").DataTable({
    dom: _dt_dom_without_export,
  })


    //  data table filter initialization
  $(".table-without-filter").DataTable({
    dom: _dt_dom_without_filter,
  })
 
  
  


  // ############################### toaster js start here  ##################### ###################################################################################


  // PNotify default
  $("#pnotify-solid-primary").on("click",function(){showNotice({type:"notice"})})
  $("#pnotify-solid-danger").on("click",function () {showNotice({type:"error"})})
  $("#pnotify-solid-success").on("click",function () {showNotice({type:"success"})})
  $("#pnotify-solid-warning").on("click",function () {showNotice({type:"warning"})})
  $("#pnotify-solid-info").on("click", function () { showNotice({ type: "info" }) })
  

  // alert position 
  $("#pnotify-top-right").on("click",function () {showNotice({type:"warning", positionX:"right"})})
  $("#pnotify-bottom-right").on("click",function () {showNotice({type:"success", positionX:"right", positionY:"up"})})
  $("#pnotify-bottom-left").on("click", function () { showNotice({ type: "error", positionX: "left", positionY: "up" }) })
  $("#pnotify-top-left").on("click", function () { showNotice({ type: "info" }) })

  // alert fll width top 
  $("#pnotify-primary-up100").on("click", function () { showNotice({ type: "notice", up100:true }) })
  $("#pnotify-danger-up100").on("click", function () { showNotice({ type: "error", up100:true }) })
  $("#pnotify-success-up100").on("click", function () { showNotice({ type: "success", up100:true }) })
  $("#pnotify-warning-up100").on("click", function () { showNotice({ type: "warning", up100:true }) })
  $("#pnotify-info-up100").on("click", function () { showNotice({ type: "info", up100: true }) })
  
  // alert full width bottom 
  $("#pnotify-primary-down75").on("click", function () { showNotice({ type: "notice", down75:true }) })
  $("#pnotify-danger-down75").on("click", function () { showNotice({ type: "error", down75:true }) })
  $("#pnotify-success-down75").on("click", function () { showNotice({ type: "success", down75:true }) })
  $("#pnotify-warning-down75").on("click", function () { showNotice({ type: "warning", down75:true }) })
  $("#pnotify-info-down75").on("click", function () { showNotice({ type: "info", down75:true }) })
   // ############################### toaster js start here  ##################### ###################################################################################




  // #############################################c sweet Alert js #####################################3###
  // ##########################################################################################################
  

  $("#sweet_success").on("click", function () {showAlert({title:"Success", text:"This is success message", type:"success"})})
  $("#sweet_error").on("click", function () { showAlert({ title: "Success", text: "This is Error message", type: "error" }) })
  $("#sweet_warning").on("click", function () {showAlert({title:"Success", text:"This is success message", type:"warning"})})
  $("#sweet_info").on("click", function () {showAlert({title:"Success", text:"This is success message", type:"info"})})
  $("#sweet_question").on("click", function () { showAlert({ title: "Success", text: "This is success message", type: "question" }) })
  // position 
  $("#sweet_top").on("click", function () {showAlert({title:"Success", text:"This is success message", type:"question", position:"top"})})
  $("#sweet_top_left").on("click", function () {showAlert({title:"Success", text:"This is success message", type:"question", position:"top-left"})})
  $("#sweet_top_right").on("click", function () {showAlert({title:"Success", text:"This is success message", type:"question", position:"top-right"})})
  $("#sweet_center_left").on("click", function () {showAlert({title:"Success", text:"This is success message", type:"question", position:"center-left"})})
  $("#sweet_center_right").on("click", function () {showAlert({title:"Success", text:"This is success message", type:"question", position:"center-right"})})
  $("#sweet_bottom").on("click", function () {showAlert({title:"Success", text:"This is success message", type:"question", position:"bottom"})})
  $("#sweet_bottom_left").on("click", function () {showAlert({title:"Success", text:"This is success message", type:"question", position:"bottom-left"})})
  $("#sweet_bottom_right").on("click", function () { showAlert({ title: "Success", text: "This is success message", type: "question", position: "bottom-right" }) })
  
  $("#sweet_text").on("click", function () {AlertWithInput({title:"Input text example", inputType:"text"})})

  // #############################################c sweet Alert js #####################################3###
  // ##########################################################################################################




// ################################################## multiple select ##############################
 // more info  https://www.cssscript.com/select-box-virtual-scroll/
  
  
    // multiple select
  
    VirtualSelect.init({ 
      ele: '#multiple-select', // element id or class pass this option 
    });
    
    
 

  // ###################################################validate form ##############################
  //              #################################################################################
  jQuery.validator.setDefaults({
    debug: true,
    success: "valid"
  })

  $("#validate-form").validate({


    // this function for highlight red border on input field 
    highlight: function (elem) {
     $(elem).addClass("border-danger")
    },
    unhighlight: function (element) {
      $(element).removeClass("border-danger");
    },


    // rules of validation .  select using html name attribute 
    rules: {
      name: {
        required: true,
        minlength: 3,
        maxlength: 20,
      },
      username: {
        required: true,
        minlength: 3,
        maxlength: 20,
      },
      password: {
        required: true,
        minlength:6,
      },
      repeat_password: {
        required: true,
        minlength: 6,
        equalTo: "#password",
      },
      email: {
        required: true,
        email: true,
      },
      repeat_email: {
        required: true,
        email: true,
        equalTo: "#email",
      },
      minimum_characters: {
        required:true,
        minlength: 10,
      },
      maximum_characters: {
        required:true,
        maxlength: 10,
      },
      textarea: {
        required: true,
      },
      url: {
        url: true,
        required: true,
      },
      data: {
        date: true,
        required:true,
      },
      checkbox: {
       required:true
      },
      file_input: {
        required: true,
      }
    },

// validation custom error message of particular validation rules field 
    messages: {
      name: {
          required: `Please enter your name`
      },
      username: {
        required:`Please Enter username`,
      },
      password: {
        required:"Please Enter Password",
      },
      repeat_password: {
        required:"Please Enter Confirm Password",
        equalTo:"Password and confirm password did't match !"
      },
      email: {
        required:"Please Enter Email Address"
      },repeat_email: {
        required:"Please Enter Confirm Email",
        equalTo:"Email and confirm Email did't match !"
      },
    }
  })
// ###################################################validate form ##############################
  //        #################################################################################






  // ######################################### button js #################################33##3
  $('.btn-loading').on('click', function () {
    var btn = $(this),
        initialText = btn.data('initial-text'),
        loadingText = btn.data('loading-text');
    btn.html(loadingText).addClass('disabled');
    setTimeout(function () {
        btn.html(initialText).removeClass('disabled');
    }, 3000)
});

// ######################################################################################################
  

  
  // ################################### nav tabs needed js don't delete this code #########################
  $(".nav-tabs .dropdown-menu .dropdown-item").on("click", function () {
    $(this).closest(".nav-item.dropdown").addClass("show")
  })
  $(".nav-tabs .nav-item").on("click", function () {
   $(this).next(".nav-item.dropdown").removeClass("show")
  })
    // ################################### nav tabs needed js don't delete this code #########################

});
