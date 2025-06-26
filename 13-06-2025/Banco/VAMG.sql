-- Adicionar a chave estrangeira para a tabela noticias na coluna autor_id logando com a tabela autores na coluna id
ALTER TABLE noticias ADD CONSTRAINT fk_noticias_autores FOREIGN KEY (autor_id) REFERENCES autores(id);

-- Verificar se a chave estrangeira foi criada corretamente
show create table blog.noticias;