<div class="panel panel-primary">
    <div class="panel-heading">
        <i class="glyphicon glyphicon-th-large pull-right hidden-xs"></i>
        <h4 class="panel-title">Dashboard</h4>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-dismissable alert-info">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>Hi <?php echo $this->session->userdata('mapro_login')['fullname']; ?>!, </strong> Welcome
                    to <?php echo sys_name(); ?>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="col-md-6 col-sm-6">
                <div>
                    <h4><b>Running Project List:</b></h4>
                    <?php
                    if (empty($projects_ongoing)) echo 'No results data';
                    else {
                        echo '<ol>';
                        foreach ($projects_ongoing as $project){
                            $url = base_url('projects/detail/') . '/' . $project['id_projects'];
                            echo '<li><a href="' . $url . '">' . $project['projects'] . '</a></li>';
                        }
                        echo '</ol>';
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div>
                    <h4><b>Finished Project List:</b></h4>
                    <?php
                    if (empty($projects_closed)) echo 'No results data';
                    else {
                        echo '<ol>';
                        //http://172.17.0.2/mapro/projects/detail/2
                        //base_url('mapro/projects/detail/')
                        foreach ($projects_closed as $project) {
                            $url = base_url('projects/detail/') . '/' . $project['id_projects'];
                            echo '<li><a href="' . $url . '">' . $project['projects'] . '</a></li>';
                        }
                        echo '</ol>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>