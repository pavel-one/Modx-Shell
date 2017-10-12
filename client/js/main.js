$(document).ready(function () {
  var editor = ace.edit("resp-file");
  editor.setTheme("ace/theme/monokai");
  editor.getSession().setMode("ace/mode/php");
  editor.getSession().setTabSize(2);
  
  $('#ace-mode').on('change',function(){
    editor.getSession().setMode('ace/mode/' +$(this).val().toLowerCase());
  });
  var loader = $('.result-block .loader');
  $('.sentShell').submit(function () {
    var th = $(this);
    loader.fadeIn();
    $.ajax({
      url: 'assets/components/shell/getResponse.php',
      type: 'POST',
      dataType: 'json',
      data: th.serialize(),
      success: function(response) {
        loader.fadeOut();
        var block = $('.result-block');
        block.find('#absolute span').text(response.absolute);
        block.find('#base span').text(response.base_path);
        block.find('#dir span').text(response.dir);
        $('[name=dir]').val(response.dir);
        var arr = response.resp;
        if (response.folder) {
          block.find('#resp ul').html('');
          arr.forEach(function(item, i) {
            if (item.folder) {
              block.find('#resp ul').append('<li class="folder">' + item.item + '</li>');
            } else {
              block.find('#resp ul').append('<li class="file">' + item.item + '</li>');
            }
            
          })
        } else {
          editor.setValue(arr);
        }
      }
    })
    return false;
  })
  $(document).on('click', '#resp ul li', function () {
    var cls = $(this).attr('class');
    var input = $('[name=dir]');
    var text = $(this).text();
    var val = input.val();
    input.val(val + text);
    $('form').submit();
  })
  $('#back').click(function() {
    var input = $('[name=dir]');
    var text = input.val();
    var arr = text.split('/');
    var arr2 = [];
    for (i = 0; i < arr.length; i++) {
      if (arr[i] !== '') {
        arr2.push(arr[i]);
      }
    }
    delete arr2[arr2.length - 1];
    input.val('/' + arr2.join('/'));
    $('form').submit();
  })
})