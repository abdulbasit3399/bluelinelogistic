var arraydata = [];
var message   = "Saved successfully."; 

function getmenus() {
  arraydata = [];
  $('#spinsavemenu').show();

  var cont = 0;
  $('#menu-to-edit li').each(function(index) {
    var dept = 0;
    for (var i = 0; i < $('#menu-to-edit li').length; i++) {
      var n = $(this)
        .attr('class')
        .indexOf('menu-item-depth-' + i);
      if (n != -1) {
        dept = i;
      }
    }
    var textoiner = $(this)
      .find('.item-edit')
      .text();
    var id = this.id.split('-');
    var textoexplotado = textoiner.split('|');
    var padre = 0;
    if (
      !!textoexplotado[textoexplotado.length - 2] &&
      textoexplotado[textoexplotado.length - 2] != id[2]
    ) {
      padre = textoexplotado[textoexplotado.length - 2];
    }
    arraydata.push({
      depth: dept,
      id: id[2],
      parent: padre,
      sort: cont
    });
    cont++;
  });
  updateitem();
  actualizarmenu();
}

function addcustommenu() {
  var labelInputs = $(".add-custom-menu-label");
  var labelMenuValues = {};
  labelInputs.each(function () {
    var language = this.dataset.lang;
    labelMenuValues[language] = this.value;    
  });
  
  $('#spincustomu').show();
  $.ajax({
    data: {
      labelmenu: JSON.stringify(labelMenuValues),
      linkmenu: $('#custom-menu-item-url').val(),
      typemenu: $('#custom-menu-item-url').val(),
      rolemenu: $('#custom-menu-item-role').val(),
      idmenu: $('#idmenu').val()
    },

    url: addcustommenur,
    type: 'POST',
    success: function(response) {
      window.location.reload();
    },
    complete: function() {
      $('#spincustomu').hide();
    }
  });
}

function addCustomMenuMulti(type) {
    var dataEleClass = '.form_select_' + type,
        dataEle = $(dataEleClass);

  $('#loading_' +  type).show();
  $.ajax({
    data: {
      ids: dataEle.val(),
      type: type,
      menu_id: $('#idmenu').val()
    },
    
    url: addCustomMenuMultiUrl,
    type: 'POST',
    success: function(response) {
      window.location.reload();
    },
    complete: function() {
      $('#loading_' +  type).hide();
    }
  });
}

function updateitem(id = 0) {
  if (id) {
    // var label = $('#idlabelmenu_' + id).val();
    let labelInputs = $(".idlabelmenu_"+ id);
    let labelMenuValues = {};
    labelInputs.each(function () {
      var language = this.dataset.lang;
      message = this.dataset.message;
      labelMenuValues[language] = this.value;    
    });
    var clases = $('#clases_menu_' + id).val();
    var url = $('#url_menu_' + id).val();
    var role_id = 0;
    if ($('#role_menu_' + id).length) {
      role_id = $('#role_menu_' + id).val();
    }

    var data = {
      label: labelMenuValues,
      clases: clases,
      url: url,
      role_id: role_id,
      id: id
    };
  } else {
    var arr_data = [];
    $('.menu-item-settings').each(function(k, v) {
      var id = $(this)
        .find('.edit-menu-item-id')
        .val();
      // var label = $(this)
      //   .find('.edit-menu-item-title')
      //   .val();
      let labelInputs = $(this).find('.edit-menu-item-title');
      let labelMenuValues = {};
      labelInputs.each(function () {
        message = this.dataset.message;
        var language = this.dataset.lang;
        labelMenuValues[language] = this.value;    
      });
      
      var clases = $(this)
        .find('.edit-menu-item-classes')
        .val();
      var url = $(this)
        .find('.edit-menu-item-url')
        .val();
      var role = $(this)
        .find('.edit-menu-item-role')
        .val();
      arr_data.push({
        id: id,
        label: labelMenuValues,
        class: clases,
        link: url,
        role_id: role
      });
    });

    var data = { arraydata: arr_data };
  }
  $.ajax({
    data: data,
    url: updateitemr,
    type: 'POST',
    beforeSend: function(xhr) {
      if (id) {
        $('#spincustomu2').show();
      }
    },
    success: function(response) {},
    complete: function() {
      if (id) {
        $('#spincustomu2').hide();
      }
    }
  });
}

function actualizarmenu() {
  let placeValue = $('.menu_location:checked').val() ? $('.menu_location:checked').val() : null
  $.ajax({
    dataType: 'json',
    data: {
      arraydata: arraydata,
      menuname: $('#menu-name').val(),
      place: placeValue,
      idmenu: $('#idmenu').val()
    },

    url: generatemenucontrolr,
    type: 'POST',
    beforeSend: function(xhr) {
      $('#spincustomu2').show();
    },
    success: function(response) {
      Toast.fire({
          icon: 'success',
          title: message,
      });
      console.log('aqu llega');
    },
    complete: function() {
      $('#spincustomu2').hide();
    }
  });
}

function deleteitem(id) {
  var r = confirm('Do you want to delete this item ?');
  if (r == true) {
    $.ajax({
      dataType: 'json',
      data: {
        id: id
      },

      url: deleteitemmenur,
      type: 'POST',
      success: function(response) {
        $('#menu-item-' + id).remove();
        window.location.reload();
      }
    });
  } else {
    return false;
  }
}

function deletemenu() {
  var r = confirm('Do you want to delete this menu ?');
  if (r == true) {
    $.ajax({
      dataType: 'json',

      data: {
        id: $('#idmenu').val()
      },

      url: deletemenugr,
      type: 'POST',
      beforeSend: function(xhr) {
        $('#spincustomu2').show();
      },
      success: function(response) {
        if (!response.error) {
          alert(response.resp);
          window.location = menuwr;
        } else {
          alert(response.resp);
        }
      },
      complete: function() {
        $('#spincustomu2').hide();
      }
    });
  } else {
    return false;
  }
}

function createnewmenu() {
  if (!!$('#menu-name').val()) {
    let placeValue = $('.menu_location:checked').val() ? $('.menu_location:checked').val() : null
    $.ajax({
      dataType: 'json',

      data: {
        menuname: $('#menu-name').val(),
        place: placeValue
      },

      url: createnewmenur,
      type: 'POST',
      success: function(response) {
        window.location = menuwr + '?menu=' + response.resp;
      }
    });
  } else {
    alert('Enter menu name!');
    $('#menu-name').focus();
    return false;
  }
}

function insertParam(key, value) {
  key = encodeURI(key);
  value = encodeURI(value);

  var kvp = document.location.search.substr(1).split('&');

  var i = kvp.length;
  var x;
  while (i--) {
    x = kvp[i].split('=');

    if (x[0] == key) {
      x[1] = value;
      kvp[i] = x.join('=');
      break;
    }
  }

  if (i < 0) {
    kvp[kvp.length] = [key, value].join('=');
  }

  //this will reload the page, it's likely better to store this until finished
  document.location.search = kvp.join('&');
}

wpNavMenu.registerChange = function() {
  getmenus();
};