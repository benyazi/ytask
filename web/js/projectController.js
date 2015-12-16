/**
 * Created by benja on 30.11.2015.
 */
var ProjectController = function(config){
    this.config = config;
    this.init();
    this.$projectId = null;
};

ProjectController.prototype.init = function(){
    var me = this;
};

ProjectController.prototype.addCurtain = function(listName){
    $("#list_"+listName).prepend('<div class="curtain"><div class="curtain-loader"></div></div>');
};
ProjectController.prototype.removeCurtain = function(listName){
    $("#list_"+listName).find('.curtain').remove();
};

ProjectController.prototype.addGlobalCurtain = function(){
    $(".workRow").prepend('<div class="curtain"><div class="curtain-loader"></div></div>');
};
ProjectController.prototype.removeGlobalCurtain = function(){
    $(".workRow").find('.curtain').remove();
};

ProjectController.prototype.addModalCurtain = function(modalId){
    $("#"+modalId+" .modal-body").prepend('<div class="curtain"><div class="curtain-loader"></div></div>');
};
ProjectController.prototype.removeModalCurtain = function(modalId){
    $("#"+modalId+" .modal-body").find('.curtain').remove();
};

ProjectController.prototype.putHtmlContent = function(listName,html){
    $("#list_"+listName).html(html);
};

ProjectController.prototype.viewProject = function(projectId) {
    var me = this;
    me.addGlobalCurtain();
    this.loadProjectForm(projectId, function(){
        me.$projectId = projectId;
        $("#projectViewModal").modal("show");
        me.updateTextarea();
        me.removeGlobalCurtain();
    });
};

ProjectController.prototype.updateTextarea = function(){
    $('#projectViewModal #ProjectType_description').trumbowyg({
        fullscreenable: false,
        btns: ['bold', 'italic', 'underline', 'strikethrough', '|', 'unorderedList', 'orderedList','|','btnGrp-lists'],
        lang: 'ru'
    });
};

ProjectController.prototype.newProject = function () {
    var me = this;
    this.loadProjectForm(null, function(){
        me.$projectId = null;
        $("#projectViewModal").modal("show");
        me.updateTextarea();
    }, false);
};

ProjectController.prototype.loadProjectForm = function(projectId, callback, isEdit) {
    if(isEdit == undefined) {isEdit=true;}
    var me = this;
    var data = {};
    //console.log(data);
    $.ajax({
        type: "POST",
        dataType: "json",
        url: me.config.getProjectUrl+"?projectId="+projectId+"&isEdit="+isEdit,
        data: data,
        success: function(data){
            //console.log(data);
            if(data.success) {
                $("#projectViewModal .modal-body").html(data.html);
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
ProjectController.prototype.saveProject = function() {
    var me = this;
    me.addModalCurtain("projectViewModal");
    var form = $("#editProjectForm");
    var data = form.serialize();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: me.config.saveUrl+'?projectId='+me.$projectId,
        data: data,
        success: function(data){
            //console.log(data);
            if(data.success && data.html != undefined) {
                $("#projectViewModal .modal-body").html(data.html);
                me.updateTextarea();
                if(me.$projectId == null) {
                    $("#projectViewModal").modal("hide");
                    window.location.reload();
                }
            }
            else if(!data.success && data.html != undefined) {
                $("#projectViewModal .modal-body").html(data.html);
                me.updateTextarea();
            }
        },
        complete: function() {
            me.removeModalCurtain("projectViewModal");
            //me.removeCurtain(listName);
        }
    });
};