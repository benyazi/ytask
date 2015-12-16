/**
 * Created by benja on 30.11.2015.
 */
var ListController = function(config){
    this.config = config;
    this.init();
    this.$issueId = null;
};

ListController.prototype.init = function(){
    var me = this;
    me.updateLists();
    /*me.$form.find("#q").on('input', function() {
     me.searchResult();
     });*/
};
ListController.prototype.updateLists = function() {
    var lists = ["TODO","INPROGRESS","TESTING","DONE"];
    var me = this;
    for(var i=0;i<lists.length;i++) {
        me.getList(lists[i]);
    }
};
ListController.prototype.getList = function(listName) {
    var me = this;
    projectId = me.config.projectId;
    me.addCurtain(listName);
    var data = {};
    //console.log(data);
    $.ajax({
        type: "POST",
        dataType: "json",
        url: me.config.getListUrl+"?listName="+listName+"&projectId="+projectId,
        data: data,
        success: function(data){
            //console.log(data);
            if(data.success) {
                me.putHtmlContent(listName, data.html);
            }
            else {

            }
        },
        complete: function() {
            me.removeCurtain(listName);
        }
    });
};

ListController.prototype.addCurtain = function(listName){
    $("#list_"+listName).prepend('<div class="curtain"><div class="curtain-loader"></div></div>');
};
ListController.prototype.removeCurtain = function(listName){
    $("#list_"+listName).find('.curtain').remove();
};

ListController.prototype.addGlobalCurtain = function(){
    $(".workRow").prepend('<div class="curtain"><div class="curtain-loader"></div></div>');
};
ListController.prototype.removeGlobalCurtain = function(){
    $(".workRow").find('.curtain').remove();
};

ListController.prototype.addModalCurtain = function(modalId){
    $("#"+modalId+" .modal-body").prepend('<div class="curtain"><div class="curtain-loader"></div></div>');
};
ListController.prototype.removeModalCurtain = function(modalId){
    $("#"+modalId+" .modal-body").find('.curtain').remove();
};

ListController.prototype.putHtmlContent = function(listName,html){
    $("#list_"+listName).html(html);
};

ListController.prototype.viewIssue = function(issueId) {
    var me = this;
    me.addGlobalCurtain();
    this.loadIssueForm(issueId, function(){
        me.$issueId = issueId;
        $("#issueViewModal").modal("show");
        me.updateTextarea();
        me.removeGlobalCurtain();
    });
};

ListController.prototype.updateTextarea = function(){
    $('#issueViewModal #IssueType_description').trumbowyg({
        fullscreenable: false,
        btns: ['bold', 'italic', 'underline', 'strikethrough', '|', 'unorderedList', 'orderedList','|','btnGrp-lists'],
        lang: 'ru'
    });
    $(".datepicker").datepicker({
        language: 'ru'
    });
};

ListController.prototype.newIssue = function (listName) {
    var me = this;
    this.loadIssueForm(null, function(){
        me.$issueId = null;
        $("#issueViewModal").modal("show");
        me.updateTextarea();
    }, false);
};

ListController.prototype.loadIssueForm = function(issueId, callback, isEdit) {
    if(isEdit == undefined) {isEdit=true;}
    var me = this;
    var projectId = me.config.projectId;
    var data = {};
    //console.log(data);
    $.ajax({
        type: "POST",
        dataType: "json",
        url: me.config.getIssueUrl+"?issueId="+issueId+"&isEdit="+isEdit+"&projectId="+projectId,
        data: data,
        success: function(data){
            //console.log(data);
            if(data.success) {
                $("#issueViewModal .modal-body").html(data.html);
                callback();
            }
            else {

            }
        },
        complete: function() {
            me.removeGlobalCurtain();
        }
    });
};
ListController.prototype.saveIssue = function() {
    var me = this;
    me.addModalCurtain("issueViewModal");
    var form = $("#editIssueForm");
    var data = form.serialize();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: me.config.saveUrl+'?issueId='+me.$issueId,
        data: data,
        success: function(data){
            //console.log(data);
            if(data.success && data.html != undefined) {
                $("#issueViewModal .modal-body").html(data.html);
                me.updateTextarea();
                me.updateLists();
                if(me.$issueId == null) {
                    $("#issueViewModal").modal("hide");
                }
            }
            else if(!data.success && data.html != undefined) {
                $("#issueViewModal .modal-body").html(data.html);
                me.updateTextarea();
            }
        },
        complete: function() {
            me.removeModalCurtain("issueViewModal");
            //me.removeCurtain(listName);
        }
    });
};

