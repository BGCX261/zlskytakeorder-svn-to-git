<?php
/**
 * 异常基础类
 * @author php-朱磊
 *
 */
class CoreException extends Exception {
	private $_type;
	
	private $_extra;
	
	public function __construct($message,$code=0,$extra=false){
		parent::__construct($message,$code);
		$this->_type=get_class($this);
		$this->_extra=$extra;
	}
	
	public function __toString(){
		$trace = $this->getTrace();
        if($this->_extra)
            // 通过throw_exception抛出的异常要去掉多余的调试信息
            array_shift($trace);
        $this->class = $trace[0]['class'];
        $this->function = $trace[0]['function'];
        $this->file = $trace[0]['file'];
        $this->line = $trace[0]['line'];
        $file   =   file($this->file);
        $traceInfo='';
        $time = date("y-m-d H:i:m");
        foreach($trace as $t) {
            $traceInfo .= '['.$time.'] '.$t['file'].' ('.$t['line'].') ';
            $traceInfo .= $t['class'].$t['type'].$t['function'].'(';
            $traceInfo .= implode(', ', $t['args']);
            $traceInfo .=")\n";
        }
        $error['message']   = $this->message;
        $error['type']      = $this->_type;
        $error['detail']    = __MODULE__.'/'.__CONTROL__.'/'.__ACTION__."\n";
        $error['detail']   .=   ($this->line-2).': '.$file[$this->line-3];
        $error['detail']   .=   ($this->line-1).': '.$file[$this->line-2];
        $error['detail']   .=   '<font color="#FF6600" >'.($this->line).': <strong>'.$file[$this->line-1].'</strong></font>';
        $error['detail']   .=   ($this->line+1).': '.$file[$this->line];
        $error['detail']   .=   ($this->line+2).': '.$file[$this->line+1];
        $error['class']     =   $this->class;
        $error['function']  =   $this->function;
        $error['file']      = $this->file;
        $error['line']      = $this->line;
        $error['trace']     = $traceInfo;

        // 记录 Exception 日志
        if(config('LOG_EXCEPTION_RECORD')) {
            Log::Write('('.$this->_type.') '.$this->message);
        }

        return $error ;
	}
}