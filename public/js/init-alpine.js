function data() {
  function getThemeFromLocalStorage() {
    // if user already changed the theme, use it
    if (window.localStorage.getItem('dark')) {
      return JSON.parse(window.localStorage.getItem('dark'))
    }

    // else return their preferences
    return (
      !!window.matchMedia &&
      window.matchMedia('(prefers-color-scheme: dark)').matches
    )
  }

  function setThemeToLocalStorage(value) {
    window.localStorage.setItem('dark', value)
  }

  return {
    dark: getThemeFromLocalStorage(),
    toggleTheme() {
      this.dark = !this.dark
      setThemeToLocalStorage(this.dark)
    },
    isSideMenuOpen: false,
    toggleSideMenu() {
      this.isSideMenuOpen = !this.isSideMenuOpen
    },
    closeSideMenu() {
      this.isSideMenuOpen = false
    },
    isNotificationsMenuOpen: false,
    toggleNotificationsMenu() {
      this.isNotificationsMenuOpen = !this.isNotificationsMenuOpen
    },
    closeNotificationsMenu() {
      this.isNotificationsMenuOpen = false
    },
    isProfileMenuOpen: false,
    toggleProfileMenu() {
      this.isProfileMenuOpen = !this.isProfileMenuOpen
    },
    closeProfileMenu() {
      this.isProfileMenuOpen = false
    },
    isPagesMenuOpen: false,
    togglePagesMenu() {
      this.isPagesMenuOpen = !this.isPagesMenuOpen
    },
    // Modal
    isModalOpen: false,
    trapCleanup: null,
    openModal() {
      this.isModalOpen = true
      this.trapCleanup = focusTrap(document.querySelector('#modal'))
    },
    closeModal() {
      this.isModalOpen = false
      this.trapCleanup()
    },
    // modal simpan
    isSimpan: false,
    dataModal: null,
    openSimpan() {
      this.isSimpan = true
      this.dataModal = focusTrap(document.querySelector('#simpan-filem'))
    },
    closeSimpan() {
      this.isSimpan = false
      this.dataModal()
    },
    // modal update film
    isUpdateFilm: false,
    dataUpdateFilm: null,
    openUpdateFilm() {
      this.isUpdateFilm = true
      this.dataUpdateFilm = focusTrap(document.querySelector('#update-filem'))
    },
    closeUpdateFilm() {
      this.isUpdateFilm = false
      this.dataUpdateFilm()
    },
    // modal hapus
    isHapus: false,
    dataHapus: null,
    openHapus() {
      this.isHapus = true
      this.dataHapus = focusTrap(document.querySelector('#hapus-filem'))
    },
    closeHapus() {
      this.isHapus = false
      this.dataHapus()
    },
    // modal tambah Auditorium
    isAuditorium: false,
    dataAuditorium: null,
    openAuditorium() {
      this.isAuditorium = true
      this.dataAuditorium = focusTrap(document.querySelector('#auditorium'))
    },
    closeAuditorium() {
      this.isAuditorium = false
      this.dataAuditorium()
    },
    // modal ubah Auditorium
    isAuditoriumUbah: false,
    dataAuditoriumUbah: null,
    openAuditoriumUbah() {
      this.isAuditoriumUbah = true
      this.dataAuditoriumUbah = focusTrap(document.querySelector('#auditorium-ubah'))
    },
    closeAuditoriumUbah() {
      this.isAuditoriumUbah = false
      this.dataAuditoriumUbah()
    },
    // modal hapus Auditorium
    isAuditoriumHapus: false,
    dataAuditoriumHapus: null,
    openAuditoriumHapus() {
      this.isAuditoriumHapus = true
      this.dataAuditoriumHapus = focusTrap(document.querySelector('#auditorium-hapus'))
    },
    closeAuditoriumHapus() {
      this.isAuditoriumHapus = false
      this.dataAuditoriumHapus()
    },
    // modal add kursi
    isKursi: false,
    dataKursi: null,
    openKursi() {
      this.isKursi = true
      this.dataKursi = focusTrap(document.querySelector('#kursi'))
    },
    closeKursi() {
      this.isKursi = false
      this.dataKursi()
    },
    // modal update kursi
    isUpdateKursi: false,
    dataUpdateKursi: null,
    openUpdateKursi() {
      this.isUpdateKursi = true
      this.dataUpdateKursi = focusTrap(document.querySelector('#update-kursi'))
    },
    closeUpdateKursi() {
      this.isUpdateKursi = false
      this.dataUpdateKursi()
    },
    // modal hapus kursi
    isHapusKursi: false,
    dataHapusKursi: null,
    openHapusKursi() {
      this.isHapusKursi = true
      this.dataHapusKursi = focusTrap(document.querySelector('#hapus-kursi'))
    },
    closeHapusKursi() {
      this.isHapusKursi = false
      this.dataHapusKursi()
    },
    // modal tambah penayangan
    isPenayangan: false,
    dataPenayangan: null,
    openPenayangan() {
      this.isPenayangan = true
      this.dataPenayangan = focusTrap(document.querySelector('#penayangan'))
    },
    closePenayangan() {
      this.isPenayangan = false
      this.dataPenayangan()
    },
    // modal ubah penayangan
    isPenayanganUbah: false,
    dataPenayanganUbah: null,
    openPenayanganUbah() {
      this.isPenayanganUbah = true
      this.dataPenayanganUbah = focusTrap(document.querySelector('#penayangan-ubah'))
    },
    closePenayanganUbah() {
      this.isPenayanganUbah = false
      this.dataPenayanganUbah()
    },
    // modal hapus penayangan
    isPenayanganHapus: false,
    dataPenayanganHapus: null,
    openPenayanganHapus() {
      this.isPenayanganHapus = true
      this.dataPenayanganHapus = focusTrap(document.querySelector('#penayangan-hapus'))
    },
    closePenayanganHapus() {
      this.isPenayanganHapus = false
      this.dataPenayanganHapus()
    },
    // modal petugas
    isPetugas: false,
    dataPetugas: null,
    openPetugas() {
      this.isPetugas = true
      this.dataPetugas = focusTrap(document.querySelector('#petugas'))
    },
    closePetugas() {
      this.isPetugas = false
      this.dataPetugas()
    },
    // modal petugas hapus
    isPetugasHapus: false,
    dataPetugasHapus: null,
    openPetugasHapus() {
      this.isPetugasHapus = true
      this.dataPetugasHapus = focusTrap(document.querySelector('#petugas-hapus'))
    },
    closePetugasHapus() {
      this.isPetugasHapus = false
      this.dataPetugasHapus()
    },
    // modal beli tiket
    isTiket: false,
    dataTiket: null,
    openTiket() {
      this.isTiket = true
      this.dataTiket = focusTrap(document.querySelector('#tiket'))
    },
    closeTiket() {
      this.isTiket = false
      this.dataTiket()
    },
    // modal hapus tiket
    isTiketHapus: false,
    dataTiketHapus: null,
    openTiketHapus() {
      this.isTiketHapus = true
      this.dataTiketHapus = focusTrap(document.querySelector('#tiket-hapus'))
    },
    closeTiketHapus() {
      this.isTiketHapus = false
      this.dataTiketHapus()
    },
  }
}
