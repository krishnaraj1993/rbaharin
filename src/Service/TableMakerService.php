<?php
namespace App\Service;

class TableMakerService
{
    public $tableHeader = 0;
    public $tableBody = 0;
    public $tableActions = 0;
    public $rowActions = 0;

    public function tableRender()
    {
        $header = $this->tableHeader($this->tableHeader, sizeof($this->tableActions));
        $body = $this->tableBody($this->tableBody, $this->rowActions, sizeof($this->tableActions));
        $content = '<div class="table-responsive"><table class="table table-striped table-bordered first" id="example">' . $header . $body . '</table></div>';
        return $content;
    }
    public function tableHeader($header, $actions = 0)
    {
        $content = '';
        foreach ($header as $key => $value) {
            $content = $content . '<th>' . $value . '</th>';
        }
        if ($actions) {
            $content = $content . '<th>Actions</th>';
        }
        $header = '<tr>' . $content . '</tr>';
        return $header;
    }
    public function tableBody($body, $rowAction, $actions = 0)
    {

        $mainContent = [];
        foreach ($body as $slno => $bodyContent) {
            $content = '';
            foreach ($bodyContent as $key => $value) {                
                $value['type'] = $value['type']!='checkbox'?'#':'checkbox';               
                switch ($value['type']) {
                    case "checkbox":
                        $checked = $value['checked']?'checked':'';
                        $fieldvalue = '<input type="checkbox" id="'.$value['id'].'" '.$value['css'].$checked.'>';
                        break;
                    default:
                        $fieldvalue = !empty($value['link']) ? '<a href=' . $value['link'] . '>' . $value['name'] . '</a>' : $value['name'];
                }              

                $content = $content . '<td >' . $fieldvalue . '</td>';
            }
            if ($actions) {
                $content = $content . '<td>' . $this->tableAction($this->tableActions, $slno) . '</td>';
            }
            $trProperty = '';
            if ($rowAction != 0) {
                foreach ($rowAction['config'][$slno]['tr'] as $property => $pvalue) {
                    $trProperty = $property . "='" . $pvalue . "'";
                }
            }
            $mainContent[] = '<tr ' . $trProperty . '>' . $content . '</tr>';
        }
        if (empty($body)) {
            $mainContent[] = '<tr style="background-color: #f4bcbc;color: black;"><td colspan="10"><center> No data found  !</center></td></tr>';
        }
        $content = implode($mainContent);
        return $content;
    }
    public function tableAction($action, $slno)
    {
        $content = '';
        foreach ($action[$slno] as $key => $value) {
            $value['type'] = empty($value['type'])?'#':'';
            switch ($value['type']) {
                case "inprogress":
                    $custom = empty($value['custom']) ? "" : $value['custom'];
                    $content = $content . '<a href="' . $value['link'] . '" ' . $custom . ' type="button" class="btn btn-' . $value['name'] . '">' . $key . '</a>';
                    break;
                default:
                    $custom = empty($value['custom']) ? "" : $value['custom'];
                    $content = $content . '<a href="' . $value['link'] . '" ' . $custom . ' type="button" class="btn btn-' . $value['name'] . '">' . $key . '</a>';
            }

        }
        return '<div class="btn-group btn-group-sm">' . $content . '</div>';
    }
}
