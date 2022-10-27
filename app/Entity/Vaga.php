<?php
namespace App\Entity;
use \App\Db\Database;
use \PDO;
class Vaga{

public $id;
/**
 * Identificador único da vaga
 * @var integer
 */

public $titulo;
/**
 * Título da Vaga
 * @var string
 */

public $descricao;
/**
 * Descrição da vaga (pode conter html)
 * @var string
 */

 public $ativo;
/**
 * Define se a vaga esá ativa
 * @var string(s/n)
 */
 public $data;   
/**
 * Data de publicação da vaga
 * @var string (mesmo ela sendo do tipo timestamp no momento que lê
 * ela sai do banco como string)
 */


 public function cadastrar(){
/**
 * Método responsável por cadastrar um nova vaga
 * @return boolean
 */

 //DEFINIR A DATA
 date_default_timezone_set('America/Sao_Paulo');
 $this->data = date('Y-m-d H:i:s');

 //INSERIR A VAGA NO BANCO
        $obDatabase = new Database ('vagas');
        //MÉTODO DO TIPO CHAVE VALOR PARA INSERIR DADOS NO BANCO <declarado em database.php>
        $this->id = $obDatabase->insert([
                            'titulo' => $this->titulo,
                            'descricao' => $this->descricao,
                            'ativo' => $this->ativo,
                            'data' => $this->data
        
        ]);

     
 //RETORNAR SUCESSO
        return true;
 }

 /**
  * Método responsável por obter as vagas do banco de dados
  * @param string $where
  * @param string $limit
  * @param string $order
  * @return array
  */
 public static function getVagas($where = null, $order = null, $limit = null){
    return  (new Database('vagas'))->select($where,$order,$limit)
                                   ->fetchAll(PDO::FETCH_CLASS,self::class);

 }

}

