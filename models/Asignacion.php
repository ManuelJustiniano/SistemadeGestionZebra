<?php

namespace app\models;

/**
 * This is the model class for table "categoria".
 *
 * @property integer $idconsultor
 * @property string $nombre
 * @property string $descripcion
 * @property string $imagen
 * @property integer $idpadre
 * @property integer $modulo
 * @property string $estado
 */
class Asignacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'asignartareas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idtarea', 'idconsultor', 'prioridad' ], 'required'],
            [['descripcion', 'idproyecto'], 'safe'],
            //[['idconsultor', 'idtarea'], 'unique', 'targetAttribute' => ['idconsultor', 'idtarea'], 'message' => 'Este consultor ya tiene asignada esta tarea.'],
            [['idconsultor', 'idtarea', 'idproyecto'], 'unique', 'targetAttribute' => ['idconsultor', 'idtarea', 'idproyecto'], 'filter' => function ($query) {
                if (!$this->isNewRecord) {
                    $query->andWhere(['not', ['idasignartarea' => $this->id]]);
                }
            }, 'message' => 'Este consultor ya tiene asignada esta tarea en este proyecto.'],
            [['fechainicio', 'fechafin'], 'date', 'format' => 'php:Y-m-d'],
            ['fechainicio', 'validarFechaInicio'],
            ['fechafin', 'validarFechaFin'],
            [['estado'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idasignartarea' => 'ID',
            'idtarea' => 'Tarea para Asignar',
            'descripcion' => 'Descripcion u Objetivo',
            'fechainicio' => 'Fecha inicial',
            'fechafin' => 'Fecha Final',
            'idconsultor' => 'Consultor',
            'idproyecto' => 'Proyecto',
            'prioridad' => 'Prioridad',
            'estado' => 'Estado',
        ];
    }


    public function validarFechaInicio($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $fechaInicioProyecto = strtotime($this->proyecto->fecha_inicio);
            $fechaInicioAsignacion = strtotime($this->fechainicio);

            if ($fechaInicioAsignacion < $fechaInicioProyecto) {
                $this->addError($attribute, 'La fecha de inicio no puede ser menor que la fecha de inicio del proyecto.');
            }
        }
    }

    public function validarFechaFin($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $fechaInicioAsignacion = strtotime($this->fechainicio);
            $fechaFinAsignacion = strtotime($this->fechafin);

            $fechaFinProyecto = strtotime($this->proyecto->fecha_fin);

            if ($fechaFinAsignacion < $fechaInicioAsignacion) {
                $this->addError($attribute, 'La fecha de fin no puede ser menor que la fecha de inicio.');
            }

            if ($fechaFinAsignacion > $fechaFinProyecto) {
                $this->addError($attribute, 'La fecha de fin no puede ser mayor que la fecha de fin del proyecto.');
            }
        }
    }


    public function validarTareaConsultor($attribute, $params)
    {
        $query = self::find()
            ->where(['idtarea' => $this->idtarea, 'idconsultor' => $this->idconsultor]);

        // Excluir el registro actual si es edición
        if (!$this->isNewRecord) {
            $query->andWhere(['not', ['idasignartarea' => $this->id]]);
        }

        if ($query->exists()) {
            $this->addError($attribute, 'Este consultor ya tiene asignada esta tarea.');
        }
    }

    public function getConsultor()
    {
        return $this->hasOne(Usuarios::className(), ['idusuario' => 'idconsultor']);
    }


    public function getProyecto()
    {
        return $this->hasOne(Proyectos::className(), ['idproyecto' => 'idproyecto']);
    }

    public function getCliente()
    {
        return $this->hasOne(Proyectos::className(), ['idproyecto' => 'idproyecto']);
    }

    public function getTareas()
    {
        return $this->hasOne(Tareas::className(), ['idtarea' => 'idtarea']);
    }

    /*
     * seccion de relaciones entre tablas
     */
    public function getCategorias()
    {
        return $this->hasMany(Asignacion::className(), ['idpadre' => 'idcategoria']);
    }



}
