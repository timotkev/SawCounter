<?php

if (!empty($milestones)) {

    foreach ($milestones as $row) {
        $id_projects = $detail['id_projects'];
        $id_milestones = $row['id_milestones'];

        ?>

        <div class="col-md-12 col-sm-12">
            <div id="data-tasks-<?php echo $row['id_milestones']; ?>">
                <h4 style="margin:5px 0px;"><i
                            class="glyphicon glyphicon-hand-right"></i> <?php echo $row['milestones']; ?></h4>

                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab-tasklists-<?php echo $row['id_milestones']; ?>"
                                          data-toggle="tab"><i class="glyphicon glyphicon-th-list"></i> Lists</a></li>
                    <li><a href="#tab-tasklists-finish-<?php echo $row['id_milestones']; ?>" data-toggle="tab"><i
                                    class="glyphicon glyphicon-check"></i> Finished Task</a></li>
                </ul>
                <div id="tab-content-<?php echo $row['id_milestones']; ?>" class="tab-content">

                    <div class="tab-pane fade active in" id="tab-tasklists-<?php echo $row['id_milestones']; ?>">

                        <button class="btn btn-primary btn-xs" type="button" style="margin:10px 0px;"
                                onClick="add_task(<?php echo $row['id_milestones']; ?>)">
                            <i class="glyphicon glyphicon-plus"></i> Add Task
                        </button>

                        <table class="table table-striped table-bordered table-hover" style="width:760px;">
                            <thead>
                            <tr style="background:#e6e6e6;">
                                <th style="width:50px;text-align:center;">No</th>
                                <th>Tasks</th>
                                <th style="width:280px;">Users</th>
                                <th style="width:70px;text-align:center;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $tasks_running = $this->m_tasks->get_tasks_running_by_id_projects_milestones($id_projects, $id_milestones);

                            if (!empty($tasks_running)) {
                                $no = 1;
                                foreach ($tasks_running as $row2) {
                                    $tasks_users = $this->m_tasks->get_assigned_user_for_task($row2['id_tasks']);
                                    $users = array();
                                    if (!empty($tasks_users)) {
                                        foreach ($tasks_users as $row3) {
                                            array_push($users, $row3['fullname']);
                                        }
                                    }
                                    echo '<tr>
												<td align="center">' . $no . '</td>
												<td>' . $row2['tasks'] . '</td>
												<td>' . join(", ", $users) . '</td>
												<td align="center">
													<a href="javascript:void(0)" class="text-success" onClick="check_tasks(' . $row2['id_tasks'] . ')" title="Close"><i class="glyphicon glyphicon-check"></i></a>
													&nbsp;
													<a href="javascript:void(0)" class="text-danger" onClick="delete_tasks(' . $row2['id_tasks'] . ')" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
												</td>
											</tr>';
                                    $no++;
                                }
                            } else {
                                echo '<tr>
											<td colspan="6" align="center">No results data</td>
										</tr>';
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="tab-tasklists-finish-<?php echo $row['id_milestones']; ?>">
                        <table class="table table-striped table-bordered table-hover"
                               style="width:760px;margin-top:10px;">
                            <thead>
                            <tr style="background:#e6e6e6;">
                                <th style="width:50px;text-align:center;">No</th>
                                <th>Tasks</th>
                                <th style="width:280px;">Users</th>
                                <th style="width:40px;text-align:center;">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $tasks_finish = $this->m_tasks->get_tasks_finish_by_id_projects_milestones($id_projects, $id_milestones);

                            if (!empty($tasks_finish)) {
                                $no = 1;
                                foreach ($tasks_finish as $row2) {

                                    $tasks_users = $this->m_tasks->get_assigned_user_for_task($row2['id_tasks']);
                                    $users = array();
                                    if (!empty($tasks_users)) {
                                        foreach ($tasks_users as $row3) {
                                            array_push($users, $row3['fullname']);
                                        }
                                    }
                                    echo '<tr>
												<td align="center">' . $no . '</td>
												<td>' . $row2['tasks'] . '</td>
												<td>' . join(", ", $users) . '</td>
												<td align="center">
													<a href="javascript:void(0)" class="text-danger" onClick="delete_tasks(' . $row2['id_tasks'] . ')" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>
												</td>
											</tr>';
                                    $no++;
                                }
                            } else {
                                echo '<tr>
											<td colspan="6" align="center">No results data</td>
										</tr>';
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <br>

            </div>
        </div>


        <?php

    } # END FOREACH

} # END IF

?>