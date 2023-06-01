const courses = [...document.querySelectorAll(".edit")]
const btnDelete = [...document.querySelectorAll(".delete")]
const mainContainer = document.querySelector(".container-courses")

courses.map((edit) => {
    edit.addEventListener("click", (i) => editCourse(i))
})
btnDelete.map((del) => {
    del.addEventListener("click", (i) => showWarning(i))
})

function editCourse(infos) {
    const idCourse = infos.target.id
    fetch(`http://localhost/atv_banco_cursos/api/findCourse.php?code=${idCourse}`)
        .then(e => e.json())
        .then(e => {
            fetch(`http://localhost/atv_banco_cursos/api/dicipline.php`)
                .then(x => x.json())
                .then(x => {
                    mainContainer.insertAdjacentHTML("beforebegin", `
                        <div class="portal">
                            <section class="edit-course">
                                <form action="sendData.php" method="post">
                                    <div class="btn-close" onClick="closeCard()">
                                        <span class="material-symbols-outlined">
                                            close
                                        </span>
                                    </div>
                                    <input type="hidden" name="code" value="${e.cd_curso}">
                                    <div class="card-course">
                                        <div class="header-card">
                                            <div class="img-course">
                                                <div style='background: ${e.background}; width: 100%; height: 100%;'></div>
                                            </div>
                                            <span class="date">${e.dt_publicacao}</span>
                                        </div>
                                        <div class="main-card">
                                            <select class="discipline" id="discipline" name="discipline">
                                                ${x.map(diciplina => {
                        return `<option value="${diciplina.id}" ${e.diciplina == diciplina.nm_diciplina && "selected"}>${diciplina.nm_diciplina}</option>`
                    })
                        }
                                            </select>
                                            <input class="title-course" id="titleCourse" name="title-course" value="${e.name}"/>
                                            <div class="flex">
                                                <strong class="course-cost">R$ 
                                                    <input name="course-cost" class="course-cost" value="${e.valor}" step="any" id="courseCost" type="number">
                                                </strong>
                    
                                                <span class="time">
                                                    <input type="number" value="${e.duracao}" name="hours">
                                                    horas
                                                </span>
                                            </div>
                
                                            <span class="createdBy">Criado por: ${e.cd_prof}</span>
                                        </div>
                                    </div>
        
                                    <button type="submit" class="btn btn-send">Enviar</button>
                                </form>
                
                
                            </section>
                        </div>
                
                    `)
                })

        })

}

function closeCard() {
    document.querySelector(".portal").remove()
}

function showWarning(info) {
    const code = info.target.id
    mainContainer.insertAdjacentHTML("beforebegin", `
        <div class="portal">
            <section class="edit-course delete-course">
                <form action="deleteCourse.php" method="post">
                    <input type="hidden" name="code" value="${code}">
                    <p>
                        Atenção: se você apagar este curso, ele será excluído permanentemente e não poderá ser recuperado. Por favor, confirme sua ação antes de prosseguir.
                    </p>
                    <div class="container-options">
                        <button type="submit">SIM</butto>
                        <button type="button" onClick="closeCard()">NÃO</butto>
                    </div>
                </form>
            </section>
        </div>
    `)
}