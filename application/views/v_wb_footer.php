</div>
<div id="framecontentFooter" name="footer" align="center">
    <h3> <?php echo 'Sie haben noch ' . $this->task->getperformertaskcountforusername($this->session->userdata('username')) . ' offene Aufgaben'; ?>
    </h3>
</div>
</body>

</html>