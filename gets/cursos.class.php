<?php
//require('inc/config.php');

class Cursos
{

	public $cursos;

	public function __construct()
	{
		$this->popularCursos();
	}

	public function popularCursos()
	{
		$this->cursos =
			array(
				'Administração (Manhã)',
				'Administração (Noite)',
				'Administração (EaD)',
				'Arquitetura e Urbanismo (Manhã)',
				// 'Biomedicina (Manhã)',
				'Ciência da Computação (Manhã)',
				'Ciência da Computação (Noite)',
				'Ciências Aeronáuticas (Manhã)',
				'Ciências Aeronáuticas (Noite)',
				// 'Ciências Contábeis (Noite)',
				// 'Ciências Contábeis (EaD)',
				'Computação Gráfica (Manhã)',
				'Comunicação Social - Jornalismo (Manhã)',
				'Comunicação Social - Publicidade e Propaganda (Manhã)',
				'Design (Manhã)',
				'Design de Moda (Manhã)',
				// 'Direito (Manhã)',
				// 'Direito (Noite)',
				'Economia (EaD)',
				'Engenharia Aeronáutica (Manhã)',
				// 'Engenharia Ambiental (Noite)',
				// 'Engenharia Biomédica (Noite)',
				'Engenharia Civil (Manhã)',
				'Engenharia Civil (Noite)',
				'Engenharia da Computação (EaD)',
				'Engenharia de Produção (EaD)',
				'Engenharia de Produção / Civil (Manhã)',
				'Engenharia de Produção / Civil (Noite)',
				'Engenharia Elétrica (Noite)',
				'Engenharia Mecânica (Manhã)',
				'Engenharia Química (Noite)',
				// 'Estética (Manhã)',
				'Negócios Internacionais (EaD)',
				'Negócios Internacionais (Noite)',
				'Pedagogia Licenciatura (EaD)',
				// 'Psicologia (Manhã)',
				// 'Psicologia (Noite)',
				'Sistemas de Informação (EaD)',
				'Superior de Tecnologia em Gestão Comercial (Noite)',
				'Superior de Tecnologia em Gestão Comercial (EaD)',
				'Superior de Tecnologia em Gestão da Tecnologia da Informação (EaD)',
				'Superior de Tecnologia em Gestão de Recursos Humanos (EaD)',
				'Superior de Tecnologia em Gestão de Segurança Privada (EaD)',
				'Superior de Tecnologia em Gestão Financeira (EaD)',
				'Superior de Tecnologia em Jogos Digitais (Noite)',
				'Superior de Tecnologia em Processos Gerenciais (EaD)',
				// 'Superior de Tecnologia em Redes de Computadores (EaD)',
				// 'Superior ee Tecnologia Estética e Cosmética (EaD)',			
			);
	}


	public function selectCurso($name, $curso_selecionado = NULL)
	{
		$cursos = $this->cursos;
		echo '<select class="form-control curso" id="curso" name="' . $name . '" data-fv-notempty="true" data-fv-field="requiredSelect" required>';
		if ($curso_selecionado != NULL) {
			echo '<option value="'.$curso_selecionado.'">'.$curso_selecionado.'</option>';
		 } else {
			echo '<option value="">Selecione</option>';
		}
		foreach ($cursos as $curso) {
			$selected = ($curso_selecionado == $curso) ? 'selected' : '';
			echo '<option ' . $selected . ' value="' . $curso . '">' . $curso . '</option>';
		}
		echo '</select>';
	}

	public function selectTurno($codigo_curso)
	{
		echo '<select class="form-control" id="turno" name="turno" data-fv-notempty="true" data-fv-field="requiredSelect" required>';
		echo '<option value="">Turno</option>';
		foreach ($this->cursos[$codigo_curso]['turno'] as $turno) {
			echo '<option value="' . $turno . '">' . $turno . '</option>';
		}
		echo '</select>';
	}

	public function selectTurnoJson($codigo_curso)
	{
		$turnos = array();
		foreach ($this->cursos[$codigo_curso]['turno'] as $turno) {
			$turnos[] = array('turno' => $turno);
		}
		return json_encode($turnos);
	}
}
