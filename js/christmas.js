/**
 * To change this template use File | Settings | File Templates.
 */
//var BASE_URL = "http://www.christmas.com/";
//var BASE_URL = "http://christmas.leftofthedot.com/";
var BASE_URL = "http://"+window.location.host+"/";
//scroll to top
var scroll = false;

function scrollTopCall()
{
    $(document).ready(function()
        {
            $('#ScrollToTop a').click(function()
            {
                $('body,html').animate({
                    scrollTop: 0
                }, 800);
            });

            $(window).scroll(
                function()
                {

                    var scroll_top = $(window).scrollTop();
                    //var window_height = $(window).height();
                    if(scroll_top>100 && !scroll)
                    {
                        //$('#ScrollToTop').css('display','block');
                        $('#ScrollToTop').fadeIn();
                        //console.log('ok');
                        scroll = true;
                    }
                    else if(scroll_top<100)
                    {
                        $('#ScrollToTop').fadeOut();
                        //$('#ScrollToTop').css('display','none');
                        //console.log('no');
                        scroll = false;
                    }


                }
            );
        }
    );

}

//load new ideas
var scroll_range=1201;
var noidea=false;
var idea_last=0;
var first_fav_load = true;
function loadNewIdeas(params,mainselector,selectorlist)
{
$(document).ready(function()
    {
        $(window).scroll(
            function()
            {
            var scroll_top = $(window).scrollTop();
    //idea_last=last_id;
            if(scroll_top>scroll_range && scroll_top>1200 && !noidea)
            {
                scroll_range=scroll_top+1;
                var last_idea_id = $('#last_idea_id').val();
                var loading_attr = $('.loading-viewer').css("display");
                if(loading_attr=='block' || last_idea_id<2)//check same request escape
                {
                    return true;
                }
                $('.loading-viewer').css("display","block");
                $.ajax({
                    url : BASE_URL+'loading.php?'+params,
                    data:{id:last_idea_id},
                    success: function(json) {
                        if(json.idea==true) {

                            //$('#container').append(html);
                            //alert(json.id);
                            $('#last_idea_id').val(json.data.last_idea_id).change();
                            if(json.data.like_last_id)
                            {
                                $('#like_last_id').val(json.data.like_last_id).change();
                            }
                           //alert($('#last_idea_id').val());
                            var items=[];
                            $.each(json.data,function(i,v)
                                {
                                    //alert(v.id);

                                if(v.id)
                                {
                                    var pid=v.id;
                                    /*
                                    if(typeof v.id === 'string'){
                                         pid= "'" + v.id + "'";
                                    }*/

                                    if(v.highlight_item!="")
                                    {
                                        var highlight_item = v.highlight_item;
                                    }
                                    else
                                    {
                                        var highlight_item = "";
                                    }
                                    var reshare = "";
                                    var like = "";
                                    var comment="";
                                    var shared_by="";
                                    var delete_button="";

                                    //login check


                                    if(v.login_check>0)
                                    {


                                        //reshare
                                        reshare='<a data-id="'+ v.id+'" onclick="if(5=='+ json.data.alert+')alert(\'Please activate membership account by email confirmation\');else reShareIdea(this); return false;" href="javascript:void(0);">'+
                                                    '<img src="'+BASE_URL+'public/images/add_idea.png" alt="share idea"/>'+
                                                '</a>';

                                        //like
                                        like = '<a href="javascript:void(0);" id="like-live-'+ v.id+'" onclick="ideaLike(\''+ v.id+'\',\'#idea-like-text\',\'#idea-like-image\',this);fb_like(\''+ v.id+'\');">';

                                        if(v.user_like_count>0)
                                        {
                                            like = like+'<img id="idea-like-image-'+ v.id+'" '+'src="'+BASE_URL+'public/images/unlike.png" alt="unlike"/>';
                                        }
                                        else
                                        {
                                            like= like+'<img id="idea-like-image-'+ v.id+'" src="'+BASE_URL+'public/images/like.png" alt="like"/>';
                                        }

                                        like = like+"</a>";

                                        //comment
                                        comment = '<a href="javascript:void(0);" onclick="if(5=='+ json.data.alert+')alert(\'Please activate membership account by email confirmation\');else  inlineComment(\''+ v.id+'\');">'+
                                                    '<img src="'+BASE_URL+'public/images/comment.png" alt="comment"/>'+
                                                 '</a>';


                                        if(( v.login_check== v.user_id)||json.data.logged_user_type>0)

                                         {
                                             if(v.id.search('donate-')== -1)
                                             {

                                              delete_button='<a href="javascript:void(0);"  onClick="if(5=='+ json.data.alert+')alert(\'Please activate membership account by email confirmation\');else  deletefun(\''+ v.id+'\');">' +
                                                             '<img src="'+BASE_URL+'public/images/delete-item.png" alt="Delete"/>' +
                                                             '</a>';
                                              }
                                             else{

                                                 delete_button="";
                                                 }
                                        }
                                    else
                                           {
                                              delete_button="";
                                               }
                                    }
                                    else
                                    {
                                        //reshare
                                        reshare = '<a  data-id="'+ v.id+'"'+
                                                  'href="'+BASE_URL+'login/?next=ideadetails/'+ v.id+'">'+
                                                  '<img src="'+BASE_URL+'public/images/add_idea.png"'+
                                                  'alt="share_idea"/></a>';
                                        //like
                                        like = '<a href="'+BASE_URL+'login/?next=ideadetails/'+ v.id+'">';

                                        like= like+'<img id="idea-like-image-'+ v.id+
                                                '" src="'+BASE_URL+'public/images/like.png" alt="like"/>';
                                        like = like+"</a>";
                                        //comment
                                        comment = '<a href="'+BASE_URL+'login/?next=ideadetails/'+ v.id+'">'+
                                                    '<img src="'+BASE_URL+'public/images/comment.png" alt="comment"/>'+
                                                  '</a>';

                                    }
                                    //shared via or by
                                    if(v.share_via==true)
                                    {
                                        shared_by = '<span class="display-block">Via '+
                                                        '<a href="'+BASE_URL+v.share_username+'">'+
                                                            '<span class="red">'+ v.share_full_name+'</span>'+
                                                        '</a>'+
                                                    '</span>'+
                                                '<span class="display-block">onto '+ v.category_links+'</span>';
                                    }
                                    else
                                    {
                                        shared_by = '<span class="display-block">Shared By '+
                                                        '<a href="'+BASE_URL+v.share_username+'">'+
                                                            '<span class="red">'+ v.share_full_name+'</span>'+
                                                        '</a>'+
                                                    '</span>'+
                                                    '<span class="display-block">onto '+ v.category_links+'</span>';
                                    }

                                    //user comments
                                    var comments = "";
                                    comments = '<div class="comment-list comment-list-selector-'+ v.id+'">';
                                    if(v.comments && v.comments.length>0)
                                    {
                                        //<div class="comment-list comment-list-selector-{$results[res].id}">
                                        //''
                                        $.each(v.comments,function(ci,cv)
                                        {
                                            if(cv && cv!=null)
                                               comments+='<div class="each-comment">'+
                                                            '<div class="idea-left">'+
                                                                '<a href="'+BASE_URL+ cv.user_name+'">'+
                                                                    '<img src="'+BASE_URL+'public/profileimages/smallthumb/'+ cv.user_image+'">'+
                                                                '</a>'+
                                                            '</div>'+
                                                            '<div class="idea-right extend-idea-right">' +
                                                                '<strong>'+cv.full_name+'</strong> '+cv.text+'+' +
                                                            '</div>'+
                                                            '<div class="clear"></div>'+
                                                            '</div>'+
                                                            '<div class="clear"></div>';
                                        });
                                    }
                                    comments = comments+'</div>';
                                    //add comment
                                    var add_comment = '<div class="comment-container comment-selector-'+ v.id+'">'+
                                                           '<span>'+
                                                                '<textarea id="comment-text-'+ v.id+'" rows="2"></textarea>'+
                                                                '<button id="comment-x-button-'+v.id+'" ' +
                                                                'onclick="inlinePostComment(\''+ v.id+'\',\'#comment-text\',\'#comment-x-button\',\'.comment-list-selector\',\'#idea-comment-text\');" ' +
                                                                'class="custom-button inline-comment-button">Comment</button>'+
                                                            '</span>'+
                                                        '</div>';
                                    if(v.comment>5)
                                    {
                                        add_comment=add_comment+
                                                    '<div class="clear"></div>'+
                                                    '<div>'+
                                                        '<a class="red" href="'+BASE_URL+'ideadetails/'+ v.id+'">All '+ v.comment+' comments...</a>' +
                                                    '</div>';
                                    }
                                    add_comment = add_comment+'<div class="clear"></div>';

                                    var price = '';
                                    if(v.price!='')
                                    {
                                        price = '<div class="thumb-price">Price: '+v.price+'</div>';
                                    }
                                    var admin_edit = "";
                                    if((json.data.logged_user_type && json.data.logged_user_type>0)/*||(json.data.logged_user && json.data.logged_user>0)*/)
                                    {
                                        admin_edit = '<div class="admin_user_edit">'+
                                            '<a style="color: #ffffff;" href="'+BASE_URL+'merge/idea/'+ v.id+'/'+ v.user_id+'/" target="_blank">Edit As Admin</a>'+
                                        '</div>'
                                    }
//start of main idea generation unit
                                    //var item = "<div "+selectorlist+"-"+ v.id+" data-id=\""+ v.id+"\" ><p><img src=\""+ v.img+"\" alt=\""+ v.img+"\">"+ v.desc+"</p></div>";
                                    var height="0px";
                                    if(v.h!="100%")
                                    {
                                        if(v.h>450)
                                        {
                                            height="450px";
                                        }
                                        else
                                        {
                                            height= v.h+"px";
                                        }
                                    }
                                    else
                                    {
                                        height= v.h;
                                    }
                                    if(height=="100%")
                                    {
                                        var image_url = v.img;
                                        height = "auto";
                                    }
                                    else
                                    {
                                      var image_url = BASE_URL+'public/ideaimages/thumb/'+ v.img;
                                    }
                                    var image_preview_url = BASE_URL+""
                                    var item ='<div '+selectorlist+ v.id+'" data-id='+ v.id+' >'+
                                              '<div class="single-idea" data-id="'+ v.id+'">'+
                                              '<div class="single-idea-border" style="'+highlight_item+'">'+

                                               '<div class="single-idea-image-all">'+
                                               '<div class="single-idea-image">'+
                                                '<a class="click-to-view" href="'+BASE_URL+'ideadetails/'+ v.id+'">'+
                                                    '<img id="single-idea-image" src="'+image_url+'" style="height: '+ height +'" class="opacity-control" alt="'+ v.idea_title+'"/>'+
                                                '</a>'+
                                                '<span class="single-idea-image-hover">'+
                                                '<span class="all-sn-buttons">'+
                                                '<ul>'+
                                                '<!--re share--><li>'+reshare+'</li>'+
                                                '<!--like-->'+'<li>' +like+'</li>'+
                                                '<!--comment--><li>'+comment+'</li>'+
                                                '</ul>'+
                                                '<span class="clear"></span>'+
                                                '</span>'+
                                                '</span>'+
                                                '</div>'+
                                                price+admin_edit+
                                                '</div>'+
                                                '<div class="idea-content">'+
                                                '<div class="idea-content-heading">'+
                                                    '<a href="'+BASE_URL+'ideadetails/'+ v.id+'">'+v.idea_title+'</a>'+
                                                '</div>'+
                                                //'<div class="black">'+ v.desc+
                                                //'</div>'+
                                                '<div class="idea-content-body-text">'+
                                                    '<span>'+
                                                        '<span id="idea-like-text-'+ v.id+'">'+v.like+'</span> Likes '+
                                                        '<span id="idea-comment-text-'+ v.id+'">'+ v.comment+'</span> Comments '+
                                                        '<span id="idea-count-text-'+ v.id+'">'+ v.share+'</span> Shares'+
                                                    '</span>'+
                                                '</div>'+
                                                '</div>'+
                                                '<div class="idea-bottom shadow-2">'+
                                                '<div class="control-all-idea">'+
                                                '<div class="idea-left">'+
                                                    '<a href="'+BASE_URL+ v.user_name+'">'+
                                                        '<img src="'+BASE_URL+'public/profileimages/smallthumb/'+ v.user_image+'" alt="Image of '+ v.user+'"/>'+
                                                    '</a>'+
                                                '</div>'+
                                                '<div class="idea-right width-148px">'+
                                                    shared_by+
                                                '</div>'+
                                                '<div class="clear"></div>'+
                                                '</div>'+
                                                comments+
                                                '<div class="clear"></div>'+
                                                 add_comment+
                                        '<div class="delete-item"> </div>'+
                                                 '<div class="delete-item">'+
                                        delete_button+

                                                '</div></div></div></div></div>';
                                    items.push(item);
                                //    console.log("DATA"+item+"EDN");
                                }
                            }
                            );//end each
                            var $container = $(mainselector);
                            var $items = $( items.join('') );
                            $items.imagesLoaded(function(){
                                $container.masonry()
                                    .append( $items ).masonry( 'appended', $items, true );
                                $('.loading-viewer').css("display","none");
                            });
                        }
                        else{
                            noidea=true;
                            $('.loading-viewer').css("display","none");
                        }
                        //console.log(json);
                        },
                        error: function()
                        {
                            //console.log($('#img-src').attr('src'));
                            $('.loading-viewer').css("display","none");
                            console.log("ajax error");
                        }
                    });
                    }/*
                    else
                    {
                        $('.loading-viewer').css("display","none");
                    }*/
                }
            );
        }
    );
}


function loadNewIdeasSearch(params,mainselector,selectorlist)
{
    $(document).ready(function()
        {
            $(window).scroll(
                function()
                {
                    var scroll_top = $(window).scrollTop();
                    //idea_last=last_id;
                    if(scroll_top>scroll_range && scroll_top>1200 && !noidea)
                    {
                        scroll_range=scroll_top+1;
                        var last_idea_id = $('#last_idea_id').val();
                        var loading_attr = $('.loading-viewer').css("display");
                        if(loading_attr=='block' || last_idea_id<2)//check same request escape
                        {
                            return true;
                        }
                        $('.loading-viewer').css("display","block");
                        $.ajax({
                            url : BASE_URL+'loading.php?'+params,
                            data:{id:last_idea_id},
                            success: function(json) {

                                if(json.idea==true) {


                                    $('#last_idea_id').val(json.data.last_idea_id).change();
                                    //alert($('#last_idea_id').val());
                                    var items=[];
                                    $.each(json.data,function(i,v)
                                        {
                                            //alert(v.id);
                                            if(v.id)
                                            {
                                                var pid=v.id;
                                                /*
                                                 if(typeof v.id === 'string'){
                                                 pid= "'" + v.id + "'";
                                                 }*/

                                                if(v.highlight_item!="")
                                                {
                                                    var highlight_item = v.highlight_item;
                                                }
                                                else
                                                {
                                                    var highlight_item = "";
                                                }
                                                var reshare = "";
                                                var like = "";
                                                var comment="";
                                                var shared_by="";
                                                var delete_button="";

                                                //login check


                                                if(v.login_check>0)
                                                {
/*
                                                    if(v.alert==5)
                                                    {
                                                        var reshare_alert = "reShareIdea(this); return false;";
                                                    }
                                                    else
                                                    {
                                                        var reshare_alert = "reShareIdea(this); return false;";
                                                    }*/

                                                    //reshare
                                                    reshare='<a data-id="'+ v.id+'" onclick="if(5=='+ json.data.alert+')alert(\'Please activate membership account by email confirmation\');else  reShareIdea(this); return false;" href="javascript:void(0);">'+
                                                        '<img src="'+BASE_URL+'public/images/add_idea.png" alt="share idea"/>'+
                                                        '</a>';

                                                    //like
                                                    like = '<a href="javascript:void(0);" id="like-live-'+ v.id+'" onclick="ideaLike(\''+ v.id+'\',\'#idea-like-text\',\'#idea-like-image\',this);">';

                                                    if(v.user_like_count>0)
                                                    {
                                                        like = like+'<img id="idea-like-image-'+ v.id+'" '+'src="'+BASE_URL+'public/images/unlike.png" alt="unlike"/>';
                                                    }
                                                    else
                                                    {
                                                        like= like+'<img id="idea-like-image-'+ v.id+'" src="'+BASE_URL+'public/images/like.png" alt="like"/>';
                                                    }

                                                    like = like+"</a>";

                                                    //comment
                                                    comment = '<a href="javascript:void(0);" onclick="if(5=='+ json.data.alert+')alert(\'Please activate membership account by email confirmation\');else  inlineComment(\''+ v.id+'\');">'+
                                                        '<img src="'+BASE_URL+'public/images/comment.png" alt="comment"/>'+
                                                        '</a>';


                                                    if( v.login_check== v.user_id)

                                                    {

                                                        delete_button='<a href="javascript:void(0);"  onClick="if(5=='+ json.data.alert+')alert(\'Please activate membership account by email confirmation\');else  deletefun(\''+ v.id+'\');">' +
                                                            '<img src="'+BASE_URL+'public/images/delete-item.png" alt="Delete"/>' +
                                                            '</a>';
                                                    }
                                                    else
                                                    {
                                                        delete_button="";
                                                    }
                                                }
                                                else
                                                {
                                                    //reshare
                                                    reshare = '<a  data-id="'+ v.id+'"'+
                                                        'href="'+BASE_URL+'login/?next=ideadetails/'+ v.id+'">'+
                                                        '<img src="'+BASE_URL+'public/images/add_idea.png"'+
                                                        'alt="share_idea"/></a>';
                                                    //like
                                                    like = '<a href="'+BASE_URL+'login/?next=ideadetails/'+ v.id+'">';

                                                    like= like+'<img id="idea-like-image-'+ v.id+
                                                        '" src="'+BASE_URL+'public/images/like.png" alt="like"/>';
                                                    like = like+"</a>";
                                                    //comment
                                                    comment = '<a href="'+BASE_URL+'login/?next=ideadetails/'+ v.id+'">'+
                                                        '<img src="'+BASE_URL+'public/images/comment.png" alt="comment"/>'+
                                                        '</a>';

                                                }
                                                //shared via or by
                                                if(v.share_via==true)
                                                {
                                                    shared_by = '<span class="display-block">Via '+
                                                        '<a href="'+BASE_URL+v.share_username+'">'+
                                                        '<span class="red">'+ v.share_full_name+'</span>'+
                                                        '</a>'+
                                                        '</span>'+
                                                        '<span class="display-block">onto '+ v.category_links+'</span>';
                                                }
                                                else
                                                {
                                                    shared_by = '<span class="display-block">Shared By '+
                                                        '<a href="'+BASE_URL+v.share_username+'">'+
                                                        '<span class="red">'+ v.share_full_name+'</span>'+
                                                        '</a>'+
                                                        '</span>'+
                                                        '<span class="display-block">onto '+ v.category_links+'</span>';
                                                }

                                                //user comments
                                                var comments = "";
                                                comments = '<div class="comment-list comment-list-selector-'+ v.id+'">';
                                                if(v.comments && v.comments.length>0)
                                                {
                                                    //<div class="comment-list comment-list-selector-{$results[res].id}">
                                                    //''
                                                    $.each(v.comments,function(ci,cv)
                                                    {
                                                        if(cv && cv!=null)
                                                            comments+='<div class="each-comment">'+
                                                                '<div class="idea-left">'+
                                                                '<a href="'+BASE_URL+ cv.user_name+'">'+
                                                                '<img src="'+BASE_URL+'public/profileimages/smallthumb/'+ cv.user_image+'">'+
                                                                '</a>'+
                                                                '</div>'+
                                                                '<div class="idea-right extend-idea-right">' +
                                                                '<strong>'+cv.full_name+'</strong> '+cv.text+'+' +
                                                                '</div>'+
                                                                '<div class="clear"></div>'+
                                                                '</div>'+
                                                                '<div class="clear"></div>';
                                                    });
                                                }
                                                comments = comments+'</div>';
                                                //add comment
                                                var add_comment = '<div class="comment-container comment-selector-'+ v.id+'">'+
                                                    '<span>'+
                                                    '<textarea id="comment-text-'+ v.id+'" rows="2"></textarea>'+
                                                    '<button id="comment-x-button-'+v.id+'" ' +
                                                    'onclick="inlinePostComment(\''+ v.id+'\',\'#comment-text\',\'#comment-x-button\',\'.comment-list-selector\',\'#idea-comment-text\');" ' +
                                                    'class="custom-button inline-comment-button">Comment</button>'+
                                                    '</span>'+
                                                    '</div>';
                                                if(v.comment>5)
                                                {
                                                    add_comment=add_comment+
                                                        '<div class="clear"></div>'+
                                                        '<div>'+
                                                        '<a class="red" href="'+BASE_URL+'ideadetails/'+ v.id+'">All '+ v.comment+' comments...</a>' +
                                                        '</div>';
                                                }
                                                add_comment = add_comment+'<div class="clear"></div>';


                                                var price = '';
                                                if(v.price!='')
                                                {
                                                    price = '<div class="thumb-price">Price: '+v.price+'</div>';
                                                }
                                                var admin_edit = "";
                                                if(json.data.logged_user_type && json.data.logged_user_type>0){
                                                   // console.log('here');
                                                    admin_edit = '<div class="admin_user_edit">'+
                                                        '<a style="color: #ffffff;" href="'+BASE_URL+'merge/idea/'+ v.id+'/'+ v.user_id+'/" target="_blank">Edit As Admin</a>'+
                                                        '</div>'
                                                }
//start of main idea generation unit
                                                //var item = "<div "+selectorlist+"-"+ v.id+" data-id=\""+ v.id+"\" ><p><img src=\""+ v.img+"\" alt=\""+ v.img+"\">"+ v.desc+"</p></div>";
                                                var height="0px";
                                                if(v.h!="100%")
                                                {
                                                    if(v.h>450)
                                                    {
                                                        height="450px";
                                                    }
                                                    else
                                                    {
                                                        height= v.h+"px";
                                                    }
                                                }
                                                else
                                                {
                                                    height= v.h;
                                                }
                                                if(height=="100%")
                                                {
                                                    var image_url = v.img;
                                                    height = "auto";
                                                }
                                                else
                                                {
                                                    var image_url = BASE_URL+'public/ideaimages/thumb/'+ v.img;
                                                }
                                                var image_preview_url = BASE_URL+""
                                                var item ='<div '+selectorlist+ v.id+'" data-id='+ v.id+' >'+
                                                    '<div class="single-idea" data-id="'+ v.id+'">'+
                                                    '<div class="single-idea-border" style="'+highlight_item+'">'+

                                                    '<div class="single-idea-image-all">'+
                                                    '<div class="single-idea-image">'+
                                                    '<a class="click-to-view" href="'+BASE_URL+'ideadetails/'+ v.id+'">'+
                                                    '<img id="single-idea-image" src="'+image_url+'" style="height: '+ height +'" class="opacity-control" alt="'+ v.idea_title+'"/>'+
                                                    '</a>'+
                                                    '<span class="single-idea-image-hover">'+
                                                    '<span class="all-sn-buttons">'+
                                                    '<ul>'+
                                                    '<!--re share--><li>'+reshare+'</li>'+
                                                    '<!--like-->'+'<li>' +like+'</li>'+
                                                    '<!--comment--><li>'+comment+'</li>'+
                                                    '</ul>'+
                                                    '<span class="clear"></span>'+
                                                    '</span>'+
                                                    '</span>'+
                                                    '</div>'+
                                                    price+admin_edit+
                                                    '</div>'+
                                                    '<div class="idea-content">'+
                                                    '<div class="idea-content-heading">'+
                                                    '<a href="'+BASE_URL+'ideadetails/'+ v.id+'">'+v.idea_title+'</a>'+
                                                    '</div>'+
                                                    //'<div class="black">'+ v.desc+
                                                    //'</div>'+
                                                    '<div class="idea-content-body-text">'+
                                                    '<span>'+
                                                    '<span id="idea-like-text-'+ v.id+'">'+v.like+'</span> Likes '+
                                                    '<span id="idea-comment-text-'+ v.id+'">'+ v.comment+'</span> Comments '+
                                                    '<span id="idea-count-text-'+ v.id+'">'+ v.share+'</span> Shares'+
                                                    '</span>'+
                                                    '</div>'+
                                                    '</div>'+
                                                    '<div class="idea-bottom shadow-2">'+
                                                    '<div class="control-all-idea">'+
                                                    '<div class="idea-left">'+
                                                    '<a href="'+BASE_URL+ v.user_name+'">'+
                                                    '<img src="'+BASE_URL+'public/profileimages/smallthumb/'+ v.user_image+'" alt="Image of '+ v.user+'"/>'+
                                                    '</a>'+
                                                    '</div>'+
                                                    '<div class="idea-right width-148px">'+
                                                    shared_by+
                                                    '</div>'+
                                                    '<div class="clear"></div>'+
                                                    '</div>'+
                                                    comments+
                                                    '<div class="clear"></div>'+
                                                    add_comment+
                                                    '<div class="delete-item"> </div>'+
                                                    '<div class="delete-item">'+
                                                    delete_button+

                                                    '</div></div></div></div></div>';
                                                items.push(item);
                                                //    console.log("DATA"+item+"EDN");
                                            }
                                        }
                                    );//end each
                                    var $container = $(mainselector);
                                    var $items = $( items.join('') );
                                    $items.imagesLoaded(function(){
                                        $container.masonry()
                                            .append( $items ).masonry( 'appended', $items, true );
                                        $('.loading-viewer').css("display","none");
                                    });
                                }
                                else{
                                    noidea=true;
                                    $('.loading-viewer').css("display","none");
                                }
                                //console.log(json);
                            },
                            error: function()
                            {

                                $('.loading-viewer').css("display","none");
                                console.log("ajax error");
                            }
                        });
                    }/*
                 else
                 {
                 $('.loading-viewer').css("display","none");
                 }*/
                }
            );
        }
    );
}


//idea generator
function ideaGenerator()
{
    /*var selector = $('#single-{$results[res].id}');
    //console.log(selector.height());
    var ch = (selector.find('.idea-content').height());
    var bh = (selector.find('.idea-bottom').height());
    var ih = (selector.find('#single-idea-image').attr('data-height'));
    var h = parseInt(ch)+parseInt(ih)+parseInt(bh)+5;
    selector.height(h);
    console.log(h);*/
    /*if ($.browser.webkit)
    {*/
        $('#container').masonry({
            itemSelector: '.box'
        });
        $(window).load(
            function()
            {
                $('#container').masonry({
                    itemSelector: '.box'
                });
            }
        );

        //3 idea
        $('.container').masonry({
            itemSelector: '.box-2'
        });
        $(window).load(
            function()
            {
                $('.container').masonry({
                    itemSelector: '.box-2'
                });
            }
        );
    /*}
    else
    {
        //3 idea
        $('.container').masonry({
            itemSelector: '.box-2'
        });
        $('#container').masonry({
            itemSelector: '.box'
        });
    }*/

    return true;
}

function view_all_comments(id, textselector, commentselector, buttonselector){

    var last_comment_id = $('#last_comment_id').val();

    $.ajax(
        {
            type:"POST",
            dataType:"json",
            url:BASE_URL+"all_comments.php",
            data:{'id':id, 'last_comment_id':last_comment_id}
            ,success:
            function(json)
            {
                $.each(json.data,function(i,v)
                    {
                        //console.log(v.id);

                        /*comment sample*/
                        var html = '<div class="people-comments">';
                        html =html+'<div class="single-people-comment">'+
                            '<div class="single-people-comment-left">'+
                            '<a href="'+BASE_URL+v.uname+'">'+
                            '<img style="width: 25px" src="'+BASE_URL+'public/profileimages/smallthumb/'+v.photo+'" alt=""/>'+
                            '</a>'+
                            '</div>'+
                            '<div class="single-people-comment-right">'+
                            '<div class="single-people-comment-authore">'+
                            '<span class="comment-left-edit">'+v.full_name+'</span>';
                            if(v.commented_user_id== v.logged_user_id){
                                html=html+'<span class="comment-right-edit"><a href="javascript:void(0);" onclick="editComment(\''+v.id+'\');">Edit</a></span>';
                            }
                            html=html+
                            '</div>'+
                            '<div class="single-people-comment-authore-comment">'+
                            '<span class="comment-edit-box" id="comment-edit-text-'+v.id+'" style="display: block;">'+v.description+
                            '</span>'+
                            '<span class="comment-edit-box comment-edit-input" data-id="'+v.id+'" id="comment-edit-'+v.id+'" style="display: none;">'+
                            '<textarea id="edit-comment">'+v.description+'</textarea></span>'+
                            '</div>'+
                            '</div>'+
                            '<div class="clear"></div>';
                        html = html+'</div>';
                        $(commentselector).append(html);

                    });
                $('.all-comments').remove();

            }



            ,error:
            function()
            {

                alert("Reload window and try again");

            }
        });

}

function openInviteFriend(type)
{
    $.colorbox(
        {

            innerWidth:"530", innerHeight:"70%",
            iframe:true,
            href:"http://"+window.location.host+"/popup_invite_friends_tolist.php?bid="+type
        }
    );

}


function viewProfilePic(selector,input,closeAndGo) {

    //document.getElementById('image_preview_src').src = input.files.item(0).getAsDataURL();

    if(!window.FileReader)
    {
        alert("We're sorry for the inconvenient. But you can't see image preview on this browser.");
        return true;
    }


    if (input.files && input.files[0]) {

        var reader = new FileReader();

        reader.onload = function (e) {
            $(selector)
                .attr('src', e.target.result)
                .width(162);
            $(selector).css('max-height','117px');
        };

        reader.readAsDataURL(input.files[0]);

    }


}

//upload image preview
function viewMyPic(selector,input,closeAndGo) {

    //document.getElementById('image_preview_src').src = input.files.item(0).getAsDataURL();

    if(!window.FileReader)
    {
        alert("We're sorry for the inconvenient. But you can't see image preview on this browser.");
        return true;
    }


    if (input.files && input.files[0]) {

        var reader = new FileReader();

        reader.onload = function (e) {
            $(selector)
                .attr('src', e.target.result)
                .width(192);
            $(selector).css('max-height','191px');
        };

        reader.readAsDataURL(input.files[0]);


        if(closeAndGo)
        {
            $.colorbox({inline:true, width:"50%", href:closeAndGo});
        }
    }


}

//create a wishlist
function resetWishList()
{
    $('#wishlist_name').val('').change();
    $("#wishlist_category").prop('selectedIndex', 0);
    $('#wishlist_description').val('').change();
    $('#error-message').html("");
    if(combo){

    }
}
function createWishList(closeSelector)
{
    var name = $('#wishlist_name').val();
    var category = $('#wishlist_category :selected').val();
    var desc = $('wishlist_description').val();
    //alert(category);
    $('#ajax_submit').val('Please wait').change();
    $('#ajax_submit').attr('disabled',true);
    $('#error-message').fadeOut();
    $.ajax(
        {
            type:"POST"
            ,dataType:"json"
            ,url:BASE_URL+"createboard.php"
            ,data:{name:name,category:category,desc:desc}
            ,success:
                function(data)
                {
                    //error-message
                    if(data.status!='success')
                    {
                        $('#error-message').fadeIn();
                        $('#error-message').html(data.message).css("color","red");
                    }
                    else
                    {
                        resetWishList();
                        $(closeSelector).colorbox.close();
                        window.location = data.url;
                    }
                    $('#ajax_submit').val('Create').change();
                    $('#ajax_submit').attr('disabled',false);
                }
            ,error:
                function()
                {
                    $('#ajax_submit').val('Create').change();
                    console.log("ajax error");
                    $('#ajax_submit').val('Create').change();
                    $('#ajax_submit').attr('disabled',false);
                }
        }
    );
}

//follow user
function followUser(id, baseurl, loginurl) {
    $.get(baseurl+"follow.php",{'id':id}, function(json){//alert(json);

        if(json.status == 0) {
            window.location.href = baseurl+'login/?next='+loginurl;
            return false;
        }

        if (json.status == 1) {
            $('#follow-link').html('Unfollow').show();
            $('#follow-text').html(json.totalfollows).show();
        }

        if (json.status == 2){
            $('#follow-link').html('Follow').show();
            $('#follow-text').html(json.totalfollows).show();
        }

    }, "json"); //get.
};

//upload image / idea

function uploadIdea()
{
    $(document).ready(function()
    {
        $('#upload-idea-form').ajaxForm({
            dataType:"json"
            ,beforeSend:function()
            {
                $('#upload_image_button').val("Please wait");
                $('#upload_image_button').attr("disabled",true);
                $('#upload-error-message-top').fadeOut();
                $('#upload-error-message-top').html("");
            }
            ,success: function(data) {
                if(data.status != 'success')
                {
                    $('#upload-error-message-top').fadeIn();
                    $('#upload-error-message-top').html(data.message);
                }
                else
                {
                    window.location = data.rurl;
                }
                $('#upload_image_button').val("Save");
                $('#upload_image_button').attr("disabled",false);
            }
            ,error:
                function()
                {
                    $('#upload_image_button').val("Save");
                    $('#upload_image_button').attr("disabled",false);
                    $('#upload-error-message-top').fadeOut();
                    $('#upload-error-message-top').html("");
                    console.log("ajax error");
                }
        });
    })
}

var global_image = {images:null, count:0};
var prev_next = 0;
//from web
function imageWebPreview(backword)
{
    //alert(global_image.count)
    if(prev_next==global_image.count)
    {
        $('#from_web_next').hide();
        $('#from_web_pre').show();
    }
    if(prev_next==0)
    {
        $('#from_web_next').show();
        $('#from_web_pre').hide();
    }
    if(prev_next>0 && prev_next<global_image.count)
    {
        $('#from_web_next').show();
        $('#from_web_pre').show();
    }
    if(global_image.count>1)
    {
        if(backword)
        {
            if(prev_next>0)
            {
                prev_next = prev_next-1;
                $('#web_preview_data').attr("src",global_image.images[prev_next]);
            }

        }
        else
        {
            if(prev_next<global_image.count && prev_next>-1)
            {
                prev_next+=1;
                $('#web_preview_data').attr("src",global_image.images[prev_next]);
            }

        }
     //   console.log(prev_next);

    }
}
function resetImagefinding(){

$('#from-web-url').val('http://');
    $('#web-error-message').html('');
}

function displayImageForWeb()
{
    $('#web_preview_data').attr("src",BASE_URL+"public/images/2012080813444173021354.jpeg");
    global_image = {images:null, count:0};
    prev_next=0;
    var from_web_display = $('#from-web-display');
    from_web_display.css('display','none');
    $.colorbox(
        {
            inline: true
            ,href: '#preview_wish_from_web'
        }
    );
    var url_selector = $('#from-web-url');
    var url = url_selector.val();
    var msg = $("#web-error-message");
    msg.fadeOut();
    msg.html("");
    if(url.length<7)
    {
        msg.fadeIn();
        msg.html("Please enter a valid url");
        return false;
    }
    else
    {
    var wait_selector = $("#find-web-wait");
    var button_selector = $('#find-web-button');
    button_selector.css("display","none");
    wait_selector.css("display","inline");
    url_selector.attr('readonly',true);
    //Find Images


    $.ajax({
        url:BASE_URL+"findimages.php?url="+url
        ,dataType:"json"
        ,success:
            function(data)
            {
                if(data.status =='success')
                {
                    $('#from_web_prev').css("display","none");

                    button_selector.css("display","inline");
                    wait_selector.css("display","none");
                    url_selector.attr('readonly',false);
                    from_web_display.css('display','block');
                    $.colorbox(
                        {
                            inline: true
                            ,href: '#preview_wish_from_web'
                        }
                    );


                    global_image = {images: data.images,count:data.images_count};
                    $('#web_preview_data').attr("src",global_image.images[0]);
                    if(global_image.count<2){
                        $('.Arrows').hide();
                    }else{
                        prev_next+=1;
                        $('#from_web_pre').hide();
                    }

                }
                else
                {
                    msg.fadeIn();
                    msg.html(data.message);
                    button_selector.css("display","inline");
                    wait_selector.css("display","none");
                    url_selector.attr('readonly',false);
                }

            }
        ,error:
            function()
            {
                msg.html("Please try again");
                button_selector.css("display","inline");
                wait_selector.css("display","none");
                url_selector.attr('readonly',false);
                $.colorbox(
                    {
                        inline: true
                        ,href: '#preview_wish_from_web'
                    }
                );
            }
    });
    }

}

function fromWebIdea()
{

    var msg = $("#web_form_message");
    var button = $('#' +
        '' +
        '');
    var board = $('#web_board').val();
    var board_desc = $('#web_board_desc').val();
    var url = $('#web_preview_data').attr("src");
    var popshop_merhcant_id = $('#web_popshop_merchant_id').val();

    var title = $('#web_idea_title').val();
    if(url.indexOf("public/images/2012080813444173021354.jpeg")>=0)
    {
        msg.fadeIn();
        msg.html("Please add image and try again");
    }
    var link = $('#from-web-url').val();

    //alert(url+"-"+board+"-"+board_desc);
    button.html("Please wait");
    button.attr("disabled",true);
    $(document).ready(function()
    {
        $.ajax({
            dataType:"json"
            ,type:"POST"
            ,url:BASE_URL+"uploadidea.php"
            ,data:{board:board,img:url,board_desc:board_desc,link:link,idea_title:title,category_ids:popshop_merhcant_id}
            ,success: function(data) {
                if(data.status != 'success')
                {
                    msg.fadeIn();
                    msg.html(data.message);
                }
                else
                {
                    window.location = data.rurl;
                }
                button.html("Save");
                button.attr("disabled",false);
            }
            ,error:
                function()
                {
                    button.html("Save");
                    button.attr("disabled",false);
                    msg.fadeOut();
                    msg.html("");
                    console.log("ajax error");
                }
        });
    });
    return false;
}

//delete idea from user board
function deletefun(x){
    var id=x;
    var r=confirm("Are you sure you want to delete this idea?");
    if(r==true){
        $(document).ready(function () {
            $.ajax({
               dataType:"json",
                type:"POST",
                url:"http://"+window.location.host+"/delete_from_user_list.php",
                data: {idea_id:id},
                success:function (result){
                if(result.status == 'deleted')
                  window.location.reload();
                    //alert("Deleted");
                }
            });
        });
    }
    else{
        return false;
    }
}


//re-share idea read
function reShareIdea(obj,product_id)
{

    if(product_id>0)
    {
        var id = product_id;
    }
    else
    {//ok
        var id = obj.getAttribute('data-id');


    }

    if(id!="")
    {
        //alert("here");
        if(product_id>0)
        {
            var goToUrl = BASE_URL+"fetchideadata.php?product_id="+id;
        }
        else
        {
            var goToUrl = BASE_URL+"fetchideadata.php?id="+id;
        }

        $.ajax({
           url:goToUrl,
           dataType:"json",
          success:
                function(data)
                {
                    if(data.status=="success")
                    {
                        $('#reshare-id').val(data.id).change();
                        $('#reshare-idea-details').val(data.details).change();
                        $('#reshare-idea-title').val(data.title).change();
                        $('#reshare-img').attr('src',data.imgurl).change();
                        $('#wishlists').prop('selectedIndex',0).change();
                        $('#reshare-error-message').html('');
                        var desc=$('#reshare-idea-details').val().length;

                        if(desc>1000){

                            $('#reshare-len-msg').html('Please keep description within 1000 letters.').show();
                            $('#reshare-idea-submit').attr("disabled",true);
                        }else{
                            $('#reshare-len-msg').html('1000');
                        }



                        $.colorbox({inline:true, width:"50%", href:"#share_idea_popup"});
                    }
                    else
                    {
                        alert(data.message);
                        //window.location=window.location;
                    }
                }
            ,error:
                function()
                {
                    console.log("ajax error re share idea");
                }

        });
    }
}

//re-share idea post
function reShareIdeaPost()
{
    $(document).ready(function()
    {
        $('#reshare-idea-form').ajaxForm({
            dataType:"json"
            ,beforeSend:function()
            {
                $('#reshare-idea-submit').val("Please wait");
                $('#reshare-idea-submit').attr("disabled",true);
                $('#reshare-error-message').fadeOut();
                $('#reshare-error-message').html("");
            }
            ,success: function(data) {
                if(data.status != 'success')
                {
                    $('#reshare-error-message').fadeIn();
                    $('#reshare-error-message').html(data.message);
                    $('#reshare-idea-submit').val("Save");
                    $('#reshare-idea-submit').attr("disabled",false);
                }
                else
                {
                    window.location = data.reshare_url;
                }


            }
            ,error:
                function()
                {
                    $('#reshare-idea-submit').val("Save");
                    $('#reshare-idea-submit').attr("disabled",false);
                    $('#reshare-error-message').fadeOut();
                    $('#reshare-error-message').html("");
                    console.log("ajax error");
                }
        });
    })
}


//count text
function countText(val, msg, limit, lenmsg, btn)
{
    var len = val.value.length;
    if (len >limit) {
        $(lenmsg).html('Maximum length('+limit+') is filled up.').css("color","red").show();
        val.value = val.value.substring(0, limit);
    }else {
        $(lenmsg).hide();
        $(msg).html(limit - len);
        $(btn).attr('disabled',false);

    }/*
    var len = $(objselector).val().length;
     console.log(len);
    var count = limit-len;

    if(len<=limit)
    {
        $(lenmsg).fadeOut();
        $(lenmsg).html('1000').hide();
        $(msg).html(count);
        $(btn).attr('disabled',false);
    }
    else
    {
        $(objselector).value = $(objselector).value.substring(0, limit);
        $(lenmsg).fadeIn();
        $(lenmsg).html('Maximum length exceed');
        $(btn).attr('disabled',true);
        $(msg).html(count);
    }*/
}
//for love  option sane as like
function ideaLove(id,textselector,imageselector,obj)
{

    if(obj)
    {
        var live_id = (obj.getAttribute("id"));
        //alert($('#'+live_id).find(imageselector+"-"+id).attr("src"));
        live_id = '#'+live_id;

        image_obj = $(live_id).find(imageselector+"-"+id).attr("src");

        var image_obj = $(live_id).find(imageselector+"-"+id);

        var parent_txt = $(live_id).parents('#single'+'-'+id);
        var text_obj = parent_txt.find(textselector+'-'+id);
        //alert(parent_txt.attr("id"));
        processIdeaLove(id,image_obj,text_obj);

    }
    else
    {
        //alert(id);
        var image_obj =  $(imageselector+'-'+id);
        var text_obj = $(textselector+'-'+id);
        processIdeaLove(id,image_obj,text_obj);
    }
}

function processIdeaLove(id, image_obj, text_obj)
{
    $.get(BASE_URL+"like.php",{'id':id}, function(json){//alert(json);

        if (json.status == 0) {
            window.location.href=BASE_URL+"login/?next=ideadetails/"+id;
            return false;
        }
        var imgsrc = BASE_URL+"public/images/";

        if (json.status == 1) {
            image_obj.attr('src',imgsrc+'heart-pein-detail-red.png').change();
            text_obj.html(json.totallikes).change();
        }
        if (json.status == 2){
            image_obj.attr('src',imgsrc+'heart-pein-detail-normal.png').change();
            text_obj.html(json.totallikes).change();
        }

    }, "json"); //get.
}

//like
function ideaLike(id,textselector,imageselector,obj)
{

    if(obj)
    {
        var live_id = (obj.getAttribute("id"));
        //alert($('#'+live_id).find(imageselector+"-"+id).attr("src"));
        live_id = '#'+live_id;

        image_obj = $(live_id).find(imageselector+"-"+id).attr("src");

        var image_obj = $(live_id).find(imageselector+"-"+id);

        var parent_txt = $(live_id).parents('#single'+'-'+id);
        var text_obj = parent_txt.find(textselector+'-'+id);
        //alert(parent_txt.attr("id"));
        processIdeaLike(id,image_obj,text_obj);

    }
    else
    {
        //alert(id);
        var image_obj =  $(imageselector+'-'+id);
        var text_obj = $(textselector+'-'+id);
        processIdeaLike(id,image_obj,text_obj);
    }
}

//idea like processor
function processIdeaLike(id, image_obj, text_obj)
{
    $.get(BASE_URL+"like.php",{id:id}, function(json){//alert(json);

        if (json.status == 0) {
            window.location.href=BASE_URL+"login/?next=ideadetails/"+id;
            return false;
        }
        var imgsrc = BASE_URL+"public/images/";

        if (json.status == 1) {
            image_obj.attr('src',imgsrc+'unlike.png').change();
            text_obj.html(json.totallikes).change();
        }
        if (json.status == 2){
            image_obj.attr('src',imgsrc+'like.png').change();
            text_obj.html(json.totallikes).change();
        }

    }, "json"); //get.
}

//fav
function ideaFav(id,textselector,imageselector)
{
    $.get(BASE_URL+"fav.php",{'id':id}, function(json){//alert(json);

        if (json.status == 0) {
            window.location.href=BASE_URL+"login/?next=ideadetails/"+id;
            return false;
        }
        imgsrc = BASE_URL+"public/images/";
        if (json.status == 1) {
            $(imageselector+'-'+id).attr('src',imgsrc+'idea-unfav.png').change();
            if(textselector){$(textselector+'-'+id).html(json.totallikes).change()};
        }

        if (json.status == 2){
            $(imageselector+'-'+id).attr('src',imgsrc+'idea-fav.png').change();
            if(textselector){$(textselector+'-'+id).html(json.totallikes).change()};
        }

    }, "json"); //get.
}

//comment
function inlineComment(id)
{
    var comment_selector = $('.comment-selector-'+id);
    var display_status = comment_selector.css('display');
    if(display_status=='none'){comment_selector.css('display','block');}
    else{comment_selector.css('display','none');}
    ideaGenerator();
}

//post comment
function inlinePostComment(id,commentarea,commentbtn,commentlist,commentcount)
{
    $(commentbtn+"-"+id).text('Please Wait').change();
    $(commentbtn+"-"+id).attr('disabled',true);

    $.ajax(
        {
            type:"POST",
            dataType:"json",
            url:BASE_URL+"postcomment.php",
            data:{'id':id, 'cmnt':$(commentarea+'-'+id).val()},
            success:
                function(json)
                {
                    if (json.status == 0) {
                        window.location.href=BASE_URL+"login/?next=ideadetails/"+id;
                        return false;
                    }else{
                        if (json.status == '-1') {
                            alert(json.msg);
                            return false;
                        }else{
                            var imgurl = BASE_URL+"public/profileimages/smallthumb/"+json.photo;
                            var html = '<div class="each-comment">';
                            html =html+'<div class="idea-left"><a href="'+imgurl+json.uname+'"><img src="'+imgurl+'" alt=""></a></div><div class="idea-right"><strong>'+json.full_name+'</strong> '+json.cmnt+'</div>';
                            html =html+"<div class='clear'></div></div>";
                            html = html+"<div class='clear'></div>";
                            $(commentlist+"-"+id).append(html);
                            $(commentcount+'-'+id).html(json.totalcomments);
                            $(commentarea+"-"+id).val('').change();
                            inlineComment(id);
                        }
                    }

                    $(commentbtn+"-"+id).text('Comment');
                    $(commentbtn+"-"+id).attr('disabled',false);
                },
            error:function()
            {
                $(commentbtn+"-"+id).text('Comment');
                $(commentbtn+"-"+id).attr('disabled',false);
                alert("Reload window and try again");
                return false;
            }
        }
    );

}

//single comment
function singleComment(id, textselector, commentselector, buttonselector)
{

        var xtextslector = $(textselector+"-"+id);

        $(textselector+"-"+id).attr('readonly',true);
        var comment = xtextslector.val();

        var button = $(buttonselector);

        button.html('<span>Please Wait...</span>');
        button.attr("readonly",true);

        commentselector = $(commentselector);

        $.ajax(
            {
                type:"POST",
                dataType:"json",
                url:BASE_URL+"postcomment.php",
                data:{'id':id, 'cmnt':comment}
                ,success:
                function(data)
                {
                    if (data.status == 0) {
                        window.location.href=BASE_URL+"login/?next=ideadetails/"+id;
                        return false;
                    }
                    else{
                        if (data.status == '-1') {
                            window.alert(data.msg);
                            button.html('<span>Comment</span>');
                            button.attr("readonly",false);
                            return false;
                        }
                        else
                        {
                            /*comment sample*/
                            var html = '<div class="people-comments">';
                            html =html+'<div class="single-people-comment">'+
                                '<div class="single-people-comment-left">'+
                                '<a href="'+BASE_URL+data.uname+'">'+
                                    '<img style="width: 25px" src="'+BASE_URL+'public/profileimages/smallthumb/'+data.photo+'" alt=""/>'+
                                '</a>'+
                                '</div>'+
                                '<div class="single-people-comment-right">'+
                                    '<div class="single-people-comment-authore">'+
                                    '<span class="comment-left-edit">'+data.full_name+'</span>'+
                                    '<span class="comment-right-edit"><a href="javascript:void(0);" onclick="editComment(\''+data.lid+'\');">Edit</a></span>'+
                                    '</div>'+
                                    '<div class="single-people-comment-authore-comment">'+
                                    '<span class="comment-edit-box" id="comment-edit-text-'+data.lid+'" style="display: block;">'+data.cmnt+
                                    '</span>'+
                                    '<span class="comment-edit-box comment-edit-input" data-id="'+data.lid+'" id="comment-edit-'+data.lid+'" style="display: none;">'+
                                    '<textarea id="edit-comment">'+data.cmnt+'</textarea></span>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="clear"></div>';
                            html = html+'</div>';
                            commentselector.html(html + commentselector.html());
                            $('.all-comments a').html("All "+data.totalcomments+" comments");
                        }
                    }

                    xtextslector.val('Add a comment...');
                    xtextslector.attr("readonly",false);

                    button.html("<span>Comment</span>");
                    button.attr("readonly",true);
                }
                ,error:
                function()
                {
                    xtextslector.val('Add a comment...');
                    xtextslector.attr("readonly",false);
                    button.html("<span>Comment</span>");
                    alert("Reload window and try again");
                    button.attr("readonly",true);
                }
            });

    return false;
}

//popup signup
function popupSignUp()
{
    //create_account_email_popup
    $.colorbox({href:BASE_URL+"emailsignup.php"});
}

function newEmailSingUp()
{
    $(document).ready(function()
    {
        var button = $('#create-email-signup');
        var msg = $("#message-email");
        $('#email-signup-form').ajaxForm({
            dataType:"json"
            ,beforeSend:function()
            {
                button.val("Please wait");
                button.attr("disabled",true);
                msg.fadeOut();
                msg.html("");
            }
            ,success: function(data) {
                if(data.status != 'success')
                {
                    msg.fadeIn();
                    msg.html(data.message);
                }
                else
                {
                    window.location = data.url;
                }
                button.val("Create Account");
                button.attr("disabled",false);
            }
            ,error:
                function()
                {
                    button.val("Create Account");
                    button.attr("disabled",false);
                    msg.fadeOut();
                    msg.html("");
                    console.log("ajax error");
                }
        });
    })
}

//embed
function embedIdea(id,image)
{
    //<div style='padding-bottom: 2px; line-height: 0px'><a href='http://www.homedecor.com/ideadetails/9574' target='_blank'><img src='http://www.homedecor.com/public/ideaimages/1344999969.jpg' border='0' width='554' height ='739'/></a></div><div style='float: left; padding-top: 0px; padding-bottom: 0px;'><p style='font-size: 10px; color: #76838b;'>Shared by cecilia hilal</a> on <a style='text-decoration: underline; color: #76838b;' href='http://www.homedecor.com/' target='_blank'>http://www.homedecor.com/</a></p></div>
    var by = $('#embed-by').val();
    var w = $('#embed-w').val();
    var h = $('#embed-h').val();

    var content = "<div style='padding-bottom: 2px; line-height: 0px'><a href='"+BASE_URL+"ideadetails/"+id+"' target='_blank'><img src='"+BASE_URL+"public/ideaimages/"+image+"' border='0' width='"+w+"' height ='"+h+"'/></a></div><div style='float: left; padding-top: 0px; padding-bottom: 0px;'><p style='font-size: 10px; color: #76838b;'>Shared by "+by+"</a> on <a style='text-decoration: underline; color: #76838b;' href='"+BASE_URL+"' target='_blank'>"+BASE_URL+"</a></p></div>";

    $('#embed-text').val(content).change();
    return false;
}

//report
function resetReportError()
{
    var button = $('#report-button');
    var msg = $('#report-message');
    button.html('Report This');
    msg.html('');
    msg.fadeOut();
}
function reportError(id)
{
    var button = $('#report-button');
    var msg = $('#report-message');
    var value_selector = $("input:radio[name=report_radio]:checked").val();

    if(value_selector)
    {
    //$('#report').colorbox.close();
    button.html('Please Wait');
    msg.html('');
    msg.fadeOut();
    $.ajax({
        url:BASE_URL+"report.php"
        ,type:"POST"
        ,dataType:"json"
        ,data:{reason:value_selector,ideasid:id}
        ,success:
            function(json)
            {
                if(json.status=='success')
                {
                    button.html('Report This');
                    msg.html('');
                    msg.fadeOut();
                    $('#report').colorbox.close();
                }
                else
                {
                    button.html('Report This');
                    msg.html(json.message);
                    msg.fadeIn();
                }
            }
        ,error:
            function()
            {
                button.html('Report This');
                msg.html('Please try again');
                msg.fadeIn();
            }
    });
    return false;
    }
    else
    {
        button.html('Report This');
        msg.html('Select a reason.');
        msg.fadeIn();
        return false;
    }
}


//preselect combo box
//upload_wishlist_combo
function preselectCombo(which, value)
{
    var which_selector = $(which);
    which_selector.val(value).change();
}


//for iFrame colorbox
function openColorBoxiFrame(url, width, height)
{
    $.colorbox(
        {
            width:width, height:height,
            iframe:true,
            href:url
        }
    );
}

function resetPopupUploadFromPc(combo)
{
    //{$BASE_URL}public/images/2012080813444173021354.jpeg
    var default_image = BASE_URL+"public/images/2012080813444173021354.jpeg";
    $("#image_preview_src").attr('src',default_image);
    if(combo){
             $('#upload_wishlist_combo').val(combo).change();
    }else{
        $('#upload_wishlist_combo').prop('selectedIndex',0);
    }
    $("#pc_upload_cat_combo").prop('selectedIndex',0);
    $("#upload-title").val("Enter a Title here...");
    $("#upload-details").val("Provide a Description...");
    $('#upload-error-message-top').html("");
    var control = $('#custom-button-browse');
    control.replaceWith( control.val('').clone( true ) );

}