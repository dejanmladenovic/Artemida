<div class="container">
	<div class="row">
		<div class="browse-pets-page col-12">
			<div class="row">
				<div class="pet-taxonomy-wrapper col-12">
					<div class="row">
						<button class="card pet-taxonomy-adoption col-lg-4 col-sm-12 <?php if($taxonomy == 'adoption')echo 'active'; ?>" value="adoption" onclick="changeTaxonomy(this)">
							<span>Usvajanje</span>
						</button>
						<button class="card pet-taxonomy-lost col-lg-4 col-sm-12 <?php if($taxonomy == 'lost')echo 'active'?>" value="lost" onclick="changeTaxonomy(this)">
							<span>Izgubljeni</span>
						</button>
						<button class="card pet-taxonomy-found col-lg-4 col-sm-12 <?php if($taxonomy == 'found')echo 'active'?>" value="found" onclick="changeTaxonomy(this)">
							<span>Pronadjeni</span>
						</button>
					</div>
				</div>
				<div class="pets-filters-wrapper col-lg-3">
					<div class="pets-filters-outter">
						<div class="pets-filters-inner">
								<div class="filters-placeholder" onclick="hideFilters()">
									<span>Filteri</span><i class="fas fa-caret-right"></i>
								</div>
								<div class="pet-filters-field">
									<span class="filter-placeholder">Ime ljubimca</span>
									<input type="text" name="pet-name">
								</div>

								<div class="pet-filters-field">
									<span class="filter-placeholder">Vrsta ljubimca</span>
									<select name="pet-type">
										<option value="">Bilo koja</option>
									</select>
								</div>
								
								<div class="pet-filters-field">
									<span class="filter-placeholder">Rasa</span>
									<select name="pet-race">
										<option value="">Bilo koja</option>
									</select>
								</div>
								<div class="pet-filters-field">
									<span class="filter-placeholder">Veličina</span>
									<select name="pet-size">
										<option value="">Bilo koja</option>
									</select>
								</div>
								<div class="pet-filters-field">
									<span class="filter-placeholder">Pol</span>
									<select name="pet-sex">
										<option value="">Bilo koji</option>
									</select>
								</div>

								<div class="pet-filters-field">
									<span class="filter-placeholder">Po stranici</span>
									<select name="per-page">
										<option>15</option>
										<option selected="">20</option>
										<option>25</option>
									</select>
								</div>

								<div class="set-filters-button">
									<button name="apply-filters" onclick="setFilters()">Pretraži</button>
								</div>
							
						</div>
					</div>
				</div>
				<div class="pets-grid-wrapper col-lg-9">
					<div class="container">
						<div class="row pets-grid">
							
							

						</div>
					</div>
				</div>
				
			</div>
			<div class="row">
				<div class="page-selector">
					<div class="pagination-links">
					</div>
				</div>
			</div>



		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo base_url() ?>/js/pet-browser.js"></script>