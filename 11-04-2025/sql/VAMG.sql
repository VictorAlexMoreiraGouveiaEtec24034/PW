USE blog;
ALTER TABLE usuarios ADD COLUMN tipoUsuario INT NOT NULL;
UPDATE blog.usuarios SET tipoUsuario = 1 WHERE id=1;