$(document).ready(function(){
    /*!*******************************************************!*\
      !*** Select fields ***!
      \*******************************************************/
    $("select.form-select").select2();
    if(typeof formatFlag !== 'undefined') {
      $(".change_language").select2({
          templateResult: formatFlag,
          templateSelection: formatState,
          minimumResultsForSearch: -1,
          width: '100%'
      });
    }
    /*!*******************************************************!*\
      !*** Color picker fields ***!
      \*******************************************************/
    if(typeof spectrum === 'function') {
        $('.color_picker_input').spectrum({
          type: "component",
          showInput: true,
          showInitial: true,
          clickoutFiresChange: true,
          allowEmpty: true,
          maxSelectionSize: 8,
      });
    }
});