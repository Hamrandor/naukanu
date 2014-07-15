<?php

if (!isset($stask) || $stask == null) {
    echo "Ihre Aufgaben : <br><br>";
    echo form_open('taskadministrator/filtertask');
    echo form_checkbox('created', true, $created, 'onclick="this.form.submit();"') . ' Nur von mir erstellte Aufgaben anzeigen' . br(2);
    echo form_close();
    echo form_open('taskadministrator/selecttask');
    echo form_hidden('created', $created);
    echo form_dropdown('sticketid', $mytasklist, null);
    echo form_submit('edit_task', 'Aufgabe bearbeiten');
    echo form_submit('create_task', 'neue Aufgabe erstellen');
    echo "<br>";
    echo form_close();
} else {
    echo form_open('taskadministrator/savetask');
    if (isset($stask['ticketid'])) {
        echo form_hidden('sticketid', $stask['ticketid']);
    }
    if (!$owntask) {
        $this->table->add_Row('Auftraggeber', $employeearray[$stask['initiatorid']]);
        $this->table->add_Row('Auftragnehmer', $employeearray[$stask['performerid']]);
        $this->table->add_Row('Termin', date("d.m.Y", strtotime($stask['duedate'])));
        //date("Y-m-d H:i:s"); 
        $statusdropdown = form_dropdown('sticketstatusid', $statusarray, $stask['ticketstatusid']);
        $this->table->add_Row('Status', $statusdropdown);
        echo $this->table->generate();
        echo form_submit('savetask', 'Aufgabe speichern');
    } else {
        $this->table->add_Row('Auftraggeber', $user['fullname']);
        $employeedropdown = form_dropdown('sperformerid', $employeearray, $stask['performerid']);
        $this->table->add_Row('Auftragnehmer', $employeedropdown);
        $due = form_dropdown('sday', $dayarray, $sday)
                . '.' . form_dropdown('smonth', $montharray, $smonth)
                . '.' . form_dropdown('syear', $yeararray, $syear);
        $this->table->add_Row('Termin', $due);
        $statusdropdown = form_dropdown('sticketstatusid', $statusarray, $stask['ticketstatusid']);
        $this->table->add_Row('Status', $statusdropdown);
        $this->table->add_Row('Aufgabe', form_input('taskname', $stask['name']));
        $this->table->add_Row('Aufgabentext', form_textarea('comment', $stask['comment']));

        echo $this->table->generate();
        echo form_submit('savetask', 'Aufgabe speichern');
    }
    echo form_close();
}
        
