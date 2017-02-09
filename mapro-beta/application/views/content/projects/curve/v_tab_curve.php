<div id="s-curve-container">
    <!-- Plotly chart will be drawn inside this DIV -->
</div>
<script type="application/javascript">
    var axis = <?php
        //echo json_encode(var_dump($detail));
        $tasks = $this->m_tasks->get_finished_tasks_by_id_projects($detail['id_projects']);
        $axis['x'] = array();
        $axis['y'] = array();
        if (!empty($tasks)) {
            $accummulatedBudget = 0;
            foreach ($tasks as $row) {
//        var_dump($row);
                array_push($axis['x'], $row['update_tasks']);
                $accummulatedBudget += $row['budget_tasks'];
                $percentage = $accummulatedBudget / $detail['budget'] * 100;
//                log_message('info', $percentage);
                array_push($axis['y'], $percentage);
            }
        } else {
        }
        echo json_encode($axis);
        ?>;
    var data = [
        {
            x: axis.x,
            y: axis.y,
            type: 'scatter'
        }
    ];

    Plotly.newPlot('s-curve-container', data);
</script>