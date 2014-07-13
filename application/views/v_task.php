<?php

if (!isset($sTask) || $sTask == null) {
    echo "Ihre Aufgaben : <br><br>";
    echo form_open('taskAdministrator/filterTask');
    echo form_checkbox('created', true, $created, 'onclick="this.form.submit();"') . ' Nur von mir erstellte Aufgaben anzeigen' . br(2);
    echo form_close();
    echo form_open('taskAdministrator/selectTask');
    echo form_hidden('created', $created);
    echo form_dropdown('sTicketID', $myTaskList, null);
    echo form_submit('edit_Task', 'Aufgabe bearbeiten');
    echo form_submit('create_Task', 'neue Aufgabe erstellen');
    echo "<br>";
    echo form_close();
} else {
    echo form_open('taskAdministrator/saveTask');
    if (isset($sTask['ticketID'])) {
        echo form_hidden('sTicketID', $sTask['ticketID']);
    }
    if (!$ownTask) {
        $this->table->add_Row('Auftraggeber', $employeeArray[$sTask['initiatorID']]);
        $this->table->add_Row('Auftragnehmer', $employeeArray[$sTask['performerID']]);
        $this->table->add_Row('Termin', date("d.m.Y", strtotime($sTask['dueDate'])));
        //date("Y-m-d H:i:s"); 
        $statusDropdown = form_dropdown('sTicketStatusID', $statusArray, $sTask['ticketStatusID']);
        $this->table->add_Row('Status', $statusDropdown);
        echo $this->table->generate();
        echo form_submit('saveTask', 'Aufgabe speichern');
    } else {
        $this->table->add_Row('Auftraggeber', $user['fullName']);
        $employeeDropdown = form_dropdown('sPerformerID', $employeeArray, $sTask['performerID']);
        $this->table->add_Row('Auftragnehmer', $employeeDropdown);
        $due = form_dropdown('sDay', $dayArray, $sDay)
                . '.' . form_dropdown('sMonth', $monthArray, $sMonth)
                . '.' . form_dropdown('sYear', $yearArray, $sYear);
        $this->table->add_Row('Termin', $due);
        $statusDropdown = form_dropdown('sTicketStatusID', $statusArray, $sTask['ticketStatusID']);
        $this->table->add_Row('Status', $statusDropdown);
        $this->table->add_Row('Aufgabe', form_input('taskName', $sTask['name']));
        $this->table->add_Row('Aufgabentext', form_textarea('comment', $sTask['comment']));

        echo $this->table->generate();
        echo form_submit('saveTask', 'Aufgabe speichern');
    }
    echo form_close();
}
        
