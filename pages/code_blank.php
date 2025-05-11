
<!-- Kod Editörü Panel Şablonu -->
<div id="codeEditorPanel" class="draggable-panel floating">
    <div id="codeEditorHeader" class="panel-header">
        <span class="title-text">Kod Editörü</span>
        <div class="panel-controls">
            <span class="minimize-btn" onclick="minimizePanel(this.closest('.draggable-panel'))">_</span>
            <span class="maximize-btn" onclick="maximizePanel(this.closest('.draggable-panel'))">□</span>
            <span class="close-btn" onclick="closeCodePanel(this.closest('.draggable-panel'))">&times;</span>
        </div>
    </div>
    <div id="codeEditorContent" class="panel-content">
        <div class="code-editor-wrapper">
            <textarea id="codeEditor" class="code-editor" spellcheck="false"></textarea>
        </div>
    </div>
</div>
