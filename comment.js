$(function () {
    var dataSend = {};
    var commentForm;
    $('#newComment button').live('click', function () {
        dataSend.userName = commentForm.find("input[name='userName']").val();
        dataSend.userEmail = commentForm.find("input[name='userEmail']").val();
        dataSend.userHost = commentForm.find("input[name='userHost']").val();
        dataSend.text = commentForm.find("textarea").val();
        var string = "123asdАБСABC";
        if(dataSend.userName.search(/[А-яЁё]/) !== -1 || dataSend.userEmail.search(/[А-яЁё]/) !== -1 || dataSend.text.search(/[А-яЁё]/) !== -1 ){
            document.getElementById('errorSymbols').innerHTML = 'Enter only latin symbols!';
            document.getElementById('errorName').innerHTML = '';
            document.getElementById('errorEmail').innerHTML = '';
            document.getElementById('errorComment').innerHTML = '';
        }
        else if(dataSend.userName == '' && dataSend.userEmail == '' && dataSend.text == ''){
            document.getElementById('errorName').innerHTML = 'Enter name!';
            document.getElementById('errorEmail').innerHTML = 'Enter your email!';
            document.getElementById('errorComment').innerHTML = 'Enter comment!';
            document.getElementById('errorSymbols').innerHTML = '';
        }
        else if(dataSend.userName == '' && dataSend.userEmail == ''){
            document.getElementById('errorName').innerHTML = 'Enter name!';
            document.getElementById('errorEmail').innerHTML = 'Enter your email!';
            document.getElementById('errorComment').innerHTML = '';
            document.getElementById('errorSymbols').innerHTML = '';
        }
        else if(dataSend.text == '' && dataSend.userEmail == ''){
            document.getElementById('errorName').innerHTML = '';
            document.getElementById('errorEmail').innerHTML = 'Enter your email!';
            document.getElementById('errorComment').innerHTML = 'Enter comment!';
            document.getElementById('errorSymbols').innerHTML = '';
        }
        else if(dataSend.userName == '' && dataSend.text == ''){
            document.getElementById('errorName').innerHTML = 'Enter name!';
            document.getElementById('errorEmail').innerHTML = '';
            document.getElementById('errorComment').innerHTML = 'Enter comment!';
            document.getElementById('errorSymbols').innerHTML = '';
        }
        else if(dataSend.userName == ''){
            document.getElementById('errorName').innerHTML = 'Enter name!';
            document.getElementById('errorEmail').innerHTML = '';
            document.getElementById('errorComment').innerHTML = '';
            document.getElementById('errorSymbols').innerHTML = '';
        }
        
        else if(dataSend.userEmail == ''){
            document.getElementById('errorName').innerHTML = '';
            document.getElementById('errorEmail').innerHTML = 'Enter your email!';
            document.getElementById('errorComment').innerHTML = '';
            document.getElementById('errorSymbols').innerHTML = '';
            }
        else if (dataSend.text == ''){
            document.getElementById('errorName').innerHTML = '';
            document.getElementById('errorEmail').innerHTML = '';
            document.getElementById('errorComment').innerHTML = 'Enter comment!';
            document.getElementById('errorSymbols').innerHTML = '';
            }
        else{
            sendData();
            updateComment();
           }
    });
    function updateComment() {
        $.ajax({
            url: 'commentShow.php',
            success: function() {
                $('#comments').load('index.php');
            }
        });
    }
    
    function createCloneCommentForm(){
        if (commentForm)
        {
            removeOriginalCommentForm();
        }
        commentForm = $('#newComment').clone();
    }  
    function removeOriginalCommentForm(){
        commentForm.remove();
        dataSend = {};
    }
    $('#addNewComment, .reply').click(function () {
        createCloneCommentForm();
        if ($(this).attr('id') == 'addNewComment')
        {
            commentForm.appendTo('#commentRoot');
        } else
        {
            var parentComment = $(this).parent().parent();
            dataSend.parent_id = parentComment.attr('id');
            var childs = parentComment.find('ul');
            if (!childs.length)
            {
                parentComment.append('<ul></ul>');
                commentForm.appendTo(parentComment.children('ul'));
            } else
                commentForm.prependTo(childs);
        }
        commentForm.show();
        return false;
    });
    $('#cancelComment').live('click', function () {
        removeOriginalCommentForm();
    });
    function sendData() {
        commentForm.find('button').hide().next().show();
        $.post("./commentAdd.php",dataSend,function(){
            formComment();
                }
        );
}
    function formComment() {
        commentForm.find('.userName').text(dataSend.userName);
        commentForm.find('.userEmail').text(dataSend.userEmail);
        commentForm.find('.userHost').text(dataSend.userHost);
        commentForm.find('.comment').text(dataSend.text);
        commentForm.find('button').remove();
        commentForm.find('.loader').remove();
        commentForm.find('#cancelComment').remove();
        commentForm.removeAttr('id');
        commentForm = null;
    }
});
