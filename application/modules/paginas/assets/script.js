(function(){
  var slug = function(str) {
    str = str.replace(/^\s+|\s+$/g, '');
    str = str.toLowerCase();

    var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
    var to   = "aaaaaeeeeeiiiiooooouuuunc------";
    for (var i=0, l=from.length ; i<l ; i++) {
      str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
    }
    str = str.replace(/[^a-z0-9 -]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-');
    
    return str;
  };

  $.validator.addMethod("isSlug", function(value, element) {
      return value == slug(value);
  }); 

  $.validator.addMethod("exists", function(value, element) {
    var validated = false;
    $.ajax({
      method: "GET",
      url: "/backend/paginas/slug/",
      async: false,
      data: {
        slug: value,
        page_id: paginaId
      },
      success: function(a){
        if(a == 1){
          validated = true;
        }
      }
    });
    return validated
  }); 


  var rules = {
    rules: {
      "page-title": {
        required: true
      },
      "page-slug": {
        required: true,
        isSlug: true,
        exists: true
      }
    },
    messages: {
      "page-title": {
        required: "El titulo es requerido.",
      },
      "page-slug": {
        required: "La url es requerida.",
        isSlug: "La url no puede contener carácteres especiales o espacios en blanco.",
        exists: "La url ya existe."
      }
    },
    errorPlacement: function (error, element ) {
      error.addClass("invalid-feedback");
      error.insertAfter(element);
    },
    highlight: function ( element, errorClass, validClass ) {
      $(element).parent().find(".form-control").addClass("is-invalid").removeClass("is-valid");
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).parent().find(".form-control").addClass("is-valid").removeClass("is-invalid");
    }
  }

  var eventPageTitle = function(){
    $('#page-slug').val(slug($(this).val()));
  };

  var eventFormSubmit = function(){

  };


  $("#paginas").validate(rules);
  $('#page-title').on('keyup', eventPageTitle);
  $('form').on('submit', eventFormSubmit);

})();