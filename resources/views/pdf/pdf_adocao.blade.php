<!DOCTYPE html>
<html>
<head>
    <title>Lista de Usuários</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
    </style>
</head>
<body>
    <h1>Formularios de Adoção</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Solicitantes</th>
                <th>CPF</th>
                <th>E-Mail</th>
                <th>Celilcar</th>
                <th>Nome do Pet</th>
                <th>Especie</th>
                <th>Raça</th>
                <th>Data de Nascimentot</th>
                <th>Data de Solcitação</th>

            </tr>
        </thead>
        <tbody>
            @foreach($formularios as $formulario)
                <tr>
                    <td>{{ $formulario->id }}</td>
                    <td>{{ $formulario->nome_solicitante }}</td>
                    <td>{{ $formulario->cpf }}</td>
                    <td>{{ $formulario->email }}</td>
                    <td>{{ $formulario->celular }}</td>
                    <td>{{ $formulario->animal->nome }}</td>
                    <td>{{ $formulario->animal->especie}}</td>
                    <td>{{ $formulario->animal->raca}}</td>
                    <td>{{ $formulario->data_nascimento }}</td>
                    <td>{{ $formulario->data_envio }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
