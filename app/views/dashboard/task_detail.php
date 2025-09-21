<?php
// Task detail view: info, comments, attachments, progress
?>
<div class="task-detail">
    <h2>Task Detail</h2>
    <div class="task-info">
        <div>Title: <span id="task-title"><!-- title --></span></div>
        <div>Description: <span id="task-desc"><!-- desc --></span></div>
        <div>Due Date: <span id="task-due"><!-- due --></span></div>
        <div>Priority: <span id="task-priority"><!-- priority --></span></div>
        <div>Status: <span id="task-status"><!-- status --></span></div>
        <div>Assigned To: <span id="task-assigned"><!-- users --></span></div>
        <div>Tags: <span id="task-tags"><!-- tags --></span></div>
        <div>Progress: <div class="progress-bar"><!-- progress --></div>
        </div>
    </div>
    <div class="task-comments">
        <h3>Comments</h3>
        <div id="comments-list"><!-- comments --></div>
        <form id="comment-form"><!-- form --></form>
    </div>
    <div class="task-attachments">
        <h3>Attachments</h3>
        <div id="attachments-list"><!-- files --></div>
        <form id="attachment-form"><!-- form --></form>
    </div>
</div>