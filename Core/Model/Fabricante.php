<?php
/**
 * This file is part of FacturaScripts
 * Copyright (C) 2013-2019 Carlos Garcia Gomez <carlos@facturascripts.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */
namespace FacturaScripts\Core\Model;

use FacturaScripts\Core\Base\Utils;

/**
 * A manufacturer of products.
 *
 * @author Carlos García Gómez  <carlos@facturascripts.com>
 * @author Artex Trading sa     <jcuello@artextrading.com>
 */
class Fabricante extends Base\ModelClass
{

    use Base\ModelTrait;

    /**
     * Primary key.
     *
     * @var string
     */
    public $codfabricante;

    /**
     * Manufacturer name.
     *
     * @var string
     */
    public $nombre;

    /**
     * Returns the name of the column that is the primary key of the model.
     *
     * @return string
     */
    public static function primaryColumn()
    {
        return 'codfabricante';
    }

    /**
     * Returns the name of the table that uses this model.
     *
     * @return string
     */
    public static function tableName()
    {
        return 'fabricantes';
    }

    /**
     * Returns True if there is no erros on properties values.
     *
     * @return bool
     */
    public function test()
    {
        $this->codfabricante = Utils::noHtml($this->codfabricante);
        $this->nombre = Utils::noHtml($this->nombre);

        if (!preg_match('/^[A-Z0-9_\+\.\-]{1,8}$/i', $this->codfabricante)) {
            self::$miniLog->alert(self::$i18n->trans('invalid-alphanumeric-code', ['%value%' => $this->codfabricante, '%column%' => 'codfabricante', '%min%' => '1', '%max%' => '8']));
        } elseif (empty($this->nombre) || strlen($this->nombre) > 100) {
            self::$miniLog->alert(self::$i18n->trans('invalid-column-lenght', ['%column%' => 'nombre', '%min%' => '1', '%max%' => '100']));
        } else {
            return parent::test();
        }

        return false;
    }
}
