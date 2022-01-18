# Desafio Husky - Sistema de entregas

## Tecnologias utilizadas
  - PHP 7.4
  - Mariadb (MySQL) 10.3
  
## Clone e executar projeto
```bash
git clone https://github.com/gersonvinicius/desafio-husky.git
cd desafio-husky/back-end
php -S 127.0.0.1:8080
```
## Tabelas para o banco de dados
```SQL
CREATE TABLE IF NOT EXISTS Entregador (
  id int NOT NULL AUTO_INCREMENT,
  nome varchar(50) NOT NULL,
  created_at datetime NOT NULL,
  PRIMARY KEY (id)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO Entregador (nome, created_at) VALUES 
('Clark Kent', CURRENT_TIMESTAMP),
('Tobey Maguire', CURRENT_TIMESTAMP),
('John Cena', CURRENT_TIMESTAMP);

CREATE TABLE IF NOT EXISTS Cliente (
  id int NOT NULL AUTO_INCREMENT,
  nome varchar(50) NOT NULL,
  created_at datetime NOT NULL,
  PRIMARY KEY (id)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO Cliente (nome, created_at) VALUES 
('Lois Lane', CURRENT_TIMESTAMP),
('Mary Jane', CURRENT_TIMESTAMP),
('Kate Triton', CURRENT_TIMESTAMP);

CREATE TABLE IF NOT EXISTS Entrega (
  id int NOT NULL AUTO_INCREMENT,
  status varchar(20) NOT NULL,
  ponto_coleta varchar(100) NOT NULL,
  ponto_destino varchar(100) NOT NULL,
  cliente_id int NOT NULL,
  entregador_id int,
  created_at datetime NOT NULL,
  FOREIGN KEY (cliente_id) REFERENCES Cliente(id) 
    ON UPDATE CASCADE 
    ON DELETE CASCADE,
  FOREIGN KEY (entregador_id) REFERENCES Entregador(id)
    ON UPDATE CASCADE 
    ON DELETE CASCADE,
  PRIMARY KEY (id)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8;
```

### Com o projeto em execução basta utilizar o Postman para testar o CRUD, selecione body -> form-data e insira os campos.
#### CREATE - POST
```bash
URL: http://localhost:8080/api/create.php
```
CAMPOS EXEMPLO:
```json
  {
    "ponto_coleta": "endereço de coleta",
    "ponto_destino": "endereço de destino",
    "cliente_id": "1",
  }
```
#### UPDATE - POST
```bash
URL: http://localhost:8080/api/update.php
```
CAMPOS EXEMPLO:
```json
  {
    "id": "1"
    "status": "Entregando",
    "ponto_coleta": "endereço de coleta",
    "ponto_destino": "endereço de destino",
    "cliente_id": "1",
    "entregador_id": "1"
  }
```
#### READ ALL - GET
```bash
URL: http://localhost:8080/api/read.php
```
#### SINGLE READ - GET
```bash
URL: http://localhost:8080/api/single_read.php/?id=1
```
#### DELETE - DELETE
```bash
URL: http://localhost:8080/api/delete.php/?id=1
```