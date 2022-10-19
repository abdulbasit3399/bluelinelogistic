<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="UTF-8">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/codemirror.css'>
    </head>
    <body translate="no" >
        <section>
            <div class="container">
                <div class="code-container">
                    <textarea id="code" class="getEditorValue">
                        {{ isset($data['additional_css']) ? $data['additional_css'] : 'Add your own CSS code here to customize the appearance and layout of your site.' }}
                    </textarea>
                    <textarea style="display:none;" class="additional_css" name="additional_css">
                        {{ isset($data['additional_css']) ? $data['additional_css'] : '' }}
                    </textarea>
                </div>
            </div>
        </section>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/codemirror.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/mode/xml/xml.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/mode/css/css.js'></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.13.4/mode/javascript/javascript.js'></script>
        <script id="rendered-js" >
            var html_value;
            var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
                styleActiveLine: true,
                lineNumbers: true,
                matchBrackets: true,
                autoCloseBrackets: true,
                autoCloseTags: true,
                mode: "htmlmixed",
            });
            $("textarea").keyup(function(){
                html_value = editor.getValue();
                $('.additional_css').empty();
                $(".additional_css").val(html_value);
            });
        </script>
    </body>
</html>